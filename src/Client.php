<?php
namespace Plexo\Sdk;

class Client implements SecurePaymentGatewayInterface
{
    const VERSION = '0.1.0';
    private $http_client;
    private $config;
    private $serverCert;
    
    private static $env = [
        'test' => 'http://testing.plexo.com.uy/plexoapi/SecurePaymentGateway.svc/',
        'prod' => 'http://www.plexo.com.uy/plexoapi/SecurePaymentGateway.svc/',
    ];

    /**
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->configureDefaults($options);
        if (!array_key_exists($this->config['env'], self::$env)) {
            throw new Exception\ConfigurationException(sprintf("Entorno '%s' no válido. Los entornos disponibles son: 'prod' y 'test'.", $this->config['env']));
        }
        $this->http_client = new \GuzzleHttp\Client([
            'base_uri' => self::$env[$this->config['env']],
            'headers' => [
                'User-Agent' => sprintf('PlexoSdk/%s %s', self::VERSION, \GuzzleHttp\default_user_agent()),
                'Accept'     => 'application/json',
            ],
        ]);
    }

    /**
     *
     * @param (array|\Plexo\Sdk\Message\Authorization) $auth
     * @return \stdClass
     * @throws \Exception
     */
    public function Authorize($auth)
    {
        if (is_array($auth)) {
            $auth = new Message\Authorization($auth);
            if (!array_key_exists('client', $this->config) || empty($this->config['client'])) {
                throw new Exception\ResultCodeException('You must provide a valid client name', ResultCode::ARGUMENT_ERROR);
            }
            $auth->client = $this->config['client'];
        }
        if (!($auth instanceof Message\Authorization)) {
            throw new Exception\PlexoException('$auth debe ser del tipo array o \Plexo\Sdk\Message\Authorization');// FIXME
        }
//        $response = $this->_exec('POST', 'Auth', $auth);
//        return $response['Response'];
        return $this->_exec('POST', 'Auth', $auth);
    }

    public function GetSupportedIssuers()
    {
        return $this->_exec('POST', 'Issuer', ['Client' => $this->config['client']]);
    }

    /**
     *
     * @param (array|\Plexo\Sdk\Message\PaymentRequest) $payment
     * @return \stdClass
     */
    public function Purchase($payment)
    {
        if (is_array($payment)) {
            $payment = new Message\PaymentRequest($payment);
            if (!array_key_exists('client', $this->config) || empty($this->config['client'])) {
                throw new Exception\ResultCodeException('You must provide a valid client name', ResultCode::ARGUMENT_ERROR);
            }
            $payment->client = $this->config['client'];
        }
        if (!($payment instanceof Message\PaymentRequest)) {
            throw new \Exception('$payment debe ser del tipo array o \Plexo\Sdk\Message\PaymentRequest');// FIXME
        }
        return $this->_exec('POST', 'Operation/Purchase', $payment);
    }

    public function Cancel($payment)
    {
        if (is_array($payment)) {
            $payment = new Message\CancelRequest($payment);
            if (!array_key_exists('client', $this->config) || empty($this->config['client'])) {
                throw new Exception\ResultCodeException('You must provide a valid client name', ResultCode::ARGUMENT_ERROR);
            }
            $payment->client = $this->config['client'];
        }
        if (!($payment instanceof Message\CancelRequest)) {
            throw new \Exception('$payment debe ser del tipo array o \Plexo\Sdk\Message\CancelRequest');// FIXME
        }
        return $this->_exec('POST', 'Operation/Cancel', $payment);
    }
    
    /**
     *
     * @param string $fingerprint
     * @return array Server response
     */
    public function GetServerPublicKey($fingerprint)
    {
        if (!preg_match('/[0-9a-fA-F]{40}/', $fingerprint)) {
            throw new Exception\PlexoException('El formato de Fingerprint no es válido.');
        }
        $path = sprintf("Key/%s", $fingerprint);
        return $this->_exec('GET', $path);
    }

    private function configureDefaults(array $config)
    {
        $defaults = [
            'env' => 'test',
            'pkey' => 0,
        ];
        if ($env = getenv('PLEXO_ENV')) {
            $defaults['env'] = $env;
        }
        if ($client = getenv('PLEXO_CREDENTIALS_CLIENT')) {
            $defaults['client'] = $client;
        }
        if ($pem_filename = getenv('PLEXO_CREDENTIALS_PEM_FILENAME')) {
            $defaults['pem_filename'] = $pem_filename;
        }
        if ($pfx_filename = getenv('PLEXO_CREDENTIALS_PFX_FILENAME')) {
            $defaults['pfx_filename'] = $pfx_filename;
        }
        if ($pfx_passphrase = getenv('PLEXO_CREDENTIALS_PFX_PASSPHRASE')) {
            $defaults['pfx_passphrase'] = $pfx_passphrase;
        }
        if ($privkey_fingerprint = getenv('PLEXO_CREDENTIALS_PRIVKEY_FINGERPRINT')) {
            $defaults['privkey_fingerprint'] = $privkey_fingerprint;
        }
        $this->config = $config + $defaults;
        if (isset($this->config['privkey_fingerprint'])) {
            $this->config['pkey'] = isset($this->config['pem_filename']) ? 1 : 2;
        } elseif(isset($this->config['pfx_filename']) && isset($this->config['pfx_passphrase'])) {
            $this->config['pkey'] = 3;
        }
    }

    /**
     *
     * @param string $http_method
     * @param string $path
     * @param Sdk\Message $message
     * @return array Server response
     * @throws Exception\HttpClientException
     * @throws Exception\ResultCodeException
     */
    private function _exec($http_method, $path, $message = null)
    {
        $options = array();
        if ($http_method === 'POST') {
            $signedRequest = new SignedRequest($message);
            $cert = $this->getCert();
            $signedRequest->sign($cert);
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json; charset=UTF-8',
                ],
                'json' => $signedRequest->toArray(),
            ];
        }
        try {
            $res = $this->http_client->request($http_method, $path, $options);
        } catch (\Exception $exc) {
            throw new Exception\HttpClientException($exc->getMessage(), $exc->getCode(), $exc);
        }
        $body = (string) $res->getBody();
        $response_obj = json_decode($body, true);

        $certificateStore = Registry::contains('CertificateProvider')
            ? Registry::get('CertificateProvider')
            : Certificate\CertificateProvider::instance();
        if (!($certificateStore instanceof Certificate\CertificateProviderInterface)) {
            throw new Exception\PlexoException(sprintf('%s debe implementar la interfaz Plexo\Sdk\Certificate\CertificateProviderInterface.', get_class($certificateStore)));
        }
        if (preg_match('/^Key\/([A-Z0-9]{40})$/', $path, $matches)) {
            if ($response_obj['Object']['Object']['Response']['Fingerprint'] === $matches[1]) {
                if ($matches[1] ==! $response_obj['Object']['Object']['Response']['Fingerprint']) {
                    throw new Exception\PlexoException('No fue posible obtener el certificado del servidor.');
                }
                $this->serverCert = Certificate\Certificate::fromServerPublicKey($response_obj['Object']['Object']['Response']['Key'], $matches[1]);
                $certificateStore->save($this->serverCert);
            }
        }
        $signedResponse = new SignedResponse($response_obj['Object']['Object'], $response_obj['Object']['Fingerprint'], $response_obj['Object']['UTCUnixTimeExpiration'], $response_obj['Signature']);
        $fingerprint = $signedResponse->getFingerprint();
        if ((!$this->serverCert || $this->serverCert->fingerprint !== $fingerprint) && !$certificateStore->getByFingerprint($fingerprint)) {
            $this->GetServerPublicKey($fingerprint);
        }
        $signedResponse->verify($this->serverCert);
        if ($response_obj['Object']['Object']['ResultCode'] !== 0) {
            throw new Exception\ResultCodeException($response_obj['Object']['Object']['ErrorMessage'], $response_obj['Object']['Object']['ResultCode']);
        }
        $response = $signedResponse->getMessage();
        return $response['Response'];
    }

    private function getCert()
    {
        switch ($this->config['pkey']) {
            case 1:
                if (!file_exists($this->config['pem_filename']) || !is_readable($this->config['pem_filename'])) {
                    throw new Exception\ConfigurationException(sprintf('Error de configuración. No es posible acceder al archivo pem \'%s\'.', $this->config['pem_filename']));
                }
                $pkey = file_get_contents($this->config['pem_filename']);
                $cert = new Certificate\Certificate(null, $pkey, $this->config['privkey_fingerprint']);
                break;
            case 2:
                if (!Registry::contains('CertificateProvider')) {
                    throw new Exception\ConfigurationException('No se ha registrado la clase \'CertificateProvider\'.');
                } 
                $certificateStore = Registry::get('CertificateProvider');
                $cert = $certificateStore->getByFingerprint($this->config['privkey_fingerprint']);
                break;
            case 3:
                if (!file_exists($this->config['pfx_filename']) || !is_readable($this->config['pfx_filename'])) {
                    throw new Exception\ConfigurationException(sprintf('Error de configuración. No es posible acceder al archivo pfx \'%s\'.', $this->config['pfx_filename']));
                }
                $cert = Certificate\Certificate::fromPfxFile($this->config['pfx_filename'], $this->config['pfx_passphrase']);
                break;
            default:
                throw new Exception\ConfigurationException('Error de configuración. Debe especificar su clave privada.');
        }
        return $cert;
    }
}
