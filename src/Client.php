<?php
namespace Plexo\Sdk;

class Client implements SecurePaymentGatewayInterface
{
    const VERSION = '0.1.0';
    private $http_client;
    
    const TEST_URI = 'http://testing.plexo.com.uy/plexoapi/SecurePaymentGateway.svc/';
    const PROD_URI = 'http://testing.plexo.com.uy/plexoapi/SecurePaymentGateway.svc/';

    /**
     *
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        $this->http_client = new \GuzzleHttp\Client([
            'base_uri' => $_ENV['PLEXO_ENDPOINT'].'/',
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
        }
        if (!($auth instanceof Message\Authorization)) {
            throw new \Exception('$auth debe ser del tipo array o \Plexo\Sdk\Message\Authorization');// FIXME
        }
        return $this->_exec('POST', 'Auth', $auth);
    }

    public function GetSupportedIssuers()
    {
        return $this->_exec('POST', 'Issuer');
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
        }
        if (!($payment instanceof Message\PaymentRequest)) {
            throw new \Exception('$payment debe ser del tipo array o \Plexo\Sdk\Message\PaymentRequest');// FIXME
        }
        return $this->_exec('POST', 'Operation/Purchase', $payment);
    }

    public function Cancel($payment)
    {
        //Message\CancelRequest
        return $this->_exec('POST', 'Operation/Cancel', $payment);
    }
    
    /**
     *
     * @param string $fingerprint
     * @return array Server response
     */
    public function GetServerPublicKey($fingerprint)
    {
        $path = sprintf("Key/%s", $fingerprint);
        return $this->_exec('GET', $path);
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
echo __METHOD__."\n";
        $options = array();
        if ($message) {
            $errors = $message->validate($message);
//            if ($errors) {
//                foreach ($errors as $err) {
//                    var_dump($err->getMessage());
//                }
//            }
            $signedRequest = new SignedRequest($message);
            $signedRequest->sign();
            $req = $signedRequest->to_array();
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json; charset=UTF-8',
                ],
                'json' => $req,
            ];
//printf("< %s\n", json_encode($req));
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
                $certificateStore->save(Certificate\Certificate::fromServerPublicKey($response_obj['Object']['Object']['Response']['Key']));
            }
        }
        $signedResponse = new SignedResponse($response_obj);
        $fingerprint = $signedResponse->getFingerprint();
        if (!$certificateStore->getByFingerprint($fingerprint)) {
            $this->GetServerPublicKey($fingerprint);
        }
        $signedResponse->verify($certificateStore->getByFingerprint($fingerprint));
        if ($response_obj['Object']['Object']['ResultCode'] !== 0) {
            throw new Exception\ResultCodeException($response_obj['Object']['Object']['ErrorMessage'], $response_obj['Object']['Object']['ResultCode']);
        }
        return $signedResponse->getResponse();
    }
}
