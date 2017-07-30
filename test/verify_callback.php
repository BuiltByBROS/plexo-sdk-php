<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

$cert = '-----BEGIN CERTIFICATE-----
MIIEqjCCApKgAwIBAgIQAJWa99PYfAz1RXGI9lIkQzANBgkqhkiG9w0BAQ0FADAQ
MQ4wDAYDVQQDDAVQbGV4bzAgFw0xNzAzMDcxMDIzMzlaGA8yMTE3MDMwNzEwMjMz
OVowEDEOMAwGA1UEAwwFUGxleG8wggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIK
AoICAQCxjCJAfz23Wq2TiskCzgSc/bHYChXF47lu3u1KfEy/lSY0i+6e3nPFTOkX
d6Uh5MWh+icwpwxd+h6rKgS82aswq9gCCFu/FQksdAsWOHzBuS6sH+1rKNC0zh0D
PjxuMPEvgMfJcOm5ciqdJSrgH1VLG9X32HsQCAjIvWh/IgUia+E5HJf1xnatgme0
q75fShZexl3v4rj2mbuxrFXBDgdPDsCp/a0TQu5o8JpU3+G1cpWYhpJeMT/LCnUs
EM12xDldfJeqdKlMPT3fwWLznxKTcvLXuDyqwjt5IADCoJ3EFjo8/BN4ZkvZqxmO
xeutDNib229BcWz0loQTfe24hhX9yXk+ANHx5lJDCh0rMv2ZVe3Gt+G3faJNK89k
Pcjx2MTjpO7hp61GMcObL3TaBly4rRW4BZJOIXjm59/V4XWz730O5RX7G0Rx4RLf
7kI6fFXIWdqdoQQqI7Jm7A61bI0Lv8oWKY084+vZ3GjwSF5p/SVU1/wVOuYilYR7
nfrCllat6PA+NeyNN4U1AfNpRtR3uJWo/GLlD7VUAVsGbIDLTRrMautH2z0HykzI
dE/w9gLkBiQLQgzy3WpwF1aj9758iS0S5tf4HOwXW8BiMFPQDs64nbs7ECsi7EbC
IhJpJl16mw0ucR0VrDJsXbZInIbw+/XNNxX3eeH1SQO+tmjeyQIDAQABMA0GCSqG
SIb3DQEBDQUAA4ICAQBVwEvKy+s3BNaNfIc/nPp9E7O4fnJKQuvIDpAJkcAtu51U
AvHUkma08SoiJiPzG5K1lx4A3nZEy/dvcYsv9MbmAJCsYUlNQ4vcjtz4xdBsTvEv
5KS5MjYL2auuTlNuFf1zogsZnxG+aJ9gup9U2L3h6r2mKccjdP9HC4ZnZ/qEk+Gp
4quGnDTIm8jq7R3qDs/f4/zfGyTZewTcwztoMS7dxiFM9IzCeWmpdGtUv0DEK8K4
ocfNXfXK6Hw6GfCqC7KVab9OUOcR+cn3ArB71QyuVNXn20bpK2GiSOpQ/8ICoRh6
FbXbRfhD8NqsU5HDqed3+MuBWM5J1CACtyjP2L74YMGvR7PbZz9TsNYE37eLEzdu
uLqSCaolYEAa/gJirsal9cyngpqEStDkr0xMsi2fXxdSUArHDj+ftOfrdFFNP1HB
EGLXJkNY1w3TUFgkwVOhxr/6BNjDjDkSVcUUBG1VvoDHLhl5l/jLLoBy6tEAApg/
MtirNqE9YtZuqN3b6BNx2kYAAnrKofxxntNr2LYoKnXCi2ETXgmYObVkB9Tvdn6z
mtJBTYozh64KYvhmFw48CC2TKzmlLT2jdHP4R375WFcIHvFzyu8B/SMxItc8nLC7
JoyX162zF1Ci8B2RtQL937QT7M62o6XVHo05SPyorrcA8L/Xtqfz+eVmafF/Mg==
-----END CERTIFICATE-----
';

$mensaje = '{"Object":{"Object":{"SessionId":"b005dea3803a4ebc813b4b14547a02e2","Client":"Sodexo","Action":3,"PaymentInstrument":{"InstrumentToken":"b0c67aec63584b34afe18dddf5bc1d23","Name":"411111XX1111","Issuer":{"Id":"11","Issuer":"Visa","Bank":null,"Variation":null,"ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/11.png"},"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$","MercuryId":0},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S","MercuryId":1}],"Status":0,"InstrumentExpiration":"2018-01-31T03:00:00Z","AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}]},"OptionalMetadata":null},"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","UTCUnixTimeExpiration":1500926006},"Signature":"FdCvLkeXVgxiBe9y+K7tGV5Qxk0ZgN83ONyUP0zXBrbVKQRIyvM3u/RrUAQc5FjtJxgKYRRXa3mklXkvcTM0kXUEwVBt+tmYWahcekF8AzB7hLqcfn6G/q6p/VExSGUJsS0E1gcTWfDw/d6azHDMRk9T/ebAlJyc/wWpEG75oQN19jMbNvD6MW8ewNAquNGIFr5bnbncibkDveipWjAeep48zb5jsMo1Q3u2XyYReQIZ9yPaqOlAQAgyyOSfADkoFkj1gkX8Qv2Wtijv/KoCk8rMwk6oZqLM3Tdlr02HSFGERG1UGWUPQzFH6u1VzdmiW8l6f0AOJFw9TvwPiTW7Caf9oxViQcWKClOZTGOPG3q+P6XLqJu+QF9/6MqQAw8pAxdSsLwRk7PPDTLmZchBWvKmG1E/eeSGF5rtxgDhm75fOmZeq6jFd9Gec5M3VJzZK6c/khmdMk2iJh9L5qyAasGYqkrd3NLXlLtP87ef6pFy1nRztzitICn9QJqZ/lCWBTVcbHxXmysU4Xy7bFuyCw/OXdzV7kErRsUd2lmy9SBWV8ytTQR96K4AnLpWizr6aRtHRCfTo8Ys10hgriHHghMuqD9hn8CDUvWineTwYcn6aw3nmI/yhN1JeM+w+1rT2IHSPkEsu2KWKwOeBXdqspIsWrEzn+Te4hGX59JQf30="}';

/**
 * $certs = Array(
 *      [cert] => -----BEGIN CERTIFICATE-----...
 *      [pkey] => -----BEGIN PRIVATE KEY-----...
 * )
 */

$arr = json_decode($mensaje, true);


// echo $mensaje;
// echo "\n";
// echo json_encode($arr);
// echo "\n";

/*
$arr = [
    'Object' => [
        'Object' => [
            'SessionId' => 'b005dea3803a4ebc813b4b14547a02e2',
            'Client' => 'Sodexo',
            'Action' => 3,
            'PaymentInstrument' => [
                'InstrumentToken' => 'b0c67aec63584b34afe18dddf5bc1d23',
                'Name' => '411111XX1111',
                'Issuer' => [
                    'Id' => '11',
                    'Issuer' => 'Visa',
                    // 'Bank' => NULL,
                    // 'Variation' => NULL,
                    'ImageUrl' => 'http://209.133.212.155/plexoweb/images/instruments/11.png',
                ],
                'SupportedCurrencies' => [
                    [
                        'CurrencyId' => 1,
                        'Name' => 'Peso',
                        'Plural' => 'Pesos',
                        'Symbol' => '$',
                        'MercuryId' => 0,
                    ],
                    [
                        'CurrencyId' => 2,
                        'Name' => 'Dólar',
                        'Plural' => 'Dólares',
                        'Symbol' => 'U$S',
                        'MercuryId' => 1,
                    ],
                ],
                'Status' => 0,
                'InstrumentExpiration' => '2018-01-31T03:00:00Z',
                'AnonInstrumentUsageTimeLimit' => 86400,
                'CreditLimits' => array (),
                'AdditionalRequirements' => [
                    [
                        'RequirementAfterTimeLimit' => 0,
                        'SecondsLeft' => 0,
                    ],
                    [
                        'RequirementAfterTimeLimit' => 1,
                        'SecondsLeft' => 0,
                    ],
                ],
            ],
            // 'OptionalMetadata' => NULL,
        ],
        'Fingerprint' => 'AEA4D5C586983A140F8B566EA81901E8BD8F8C9F',
        'UTCUnixTimeExpiration' => 1500926006,
    ],
    'Signature' => 'FdCvLkeXVgxiBe9y+K7tGV5Qxk0ZgN83ONyUP0zXBrbVKQRIyvM3u/RrUAQc5FjtJxgKYRRXa3mklXkvcTM0kXUEwVBt+tmYWahcekF8AzB7hLqcfn6G/q6p/VExSGUJsS0E1gcTWfDw/d6azHDMRk9T/ebAlJyc/wWpEG75oQN19jMbNvD6MW8ewNAquNGIFr5bnbncibkDveipWjAeep48zb5jsMo1Q3u2XyYReQIZ9yPaqOlAQAgyyOSfADkoFkj1gkX8Qv2Wtijv/KoCk8rMwk6oZqLM3Tdlr02HSFGERG1UGWUPQzFH6u1VzdmiW8l6f0AOJFw9TvwPiTW7Caf9oxViQcWKClOZTGOPG3q+P6XLqJu+QF9/6MqQAw8pAxdSsLwRk7PPDTLmZchBWvKmG1E/eeSGF5rtxgDhm75fOmZeq6jFd9Gec5M3VJzZK6c/khmdMk2iJh9L5qyAasGYqkrd3NLXlLtP87ef6pFy1nRztzitICn9QJqZ/lCWBTVcbHxXmysU4Xy7bFuyCw/OXdzV7kErRsUd2lmy9SBWV8ytTQR96K4AnLpWizr6aRtHRCfTo8Ys10hgriHHghMuqD9hn8CDUvWineTwYcn6aw3nmI/yhN1JeM+w+1rT2IHSPkEsu2KWKwOeBXdqspIsWrEzn+Te4hGX59JQf30=',
];
*/

// ksort($arr['Object'], SORT_REGULAR);
ksortRecursive($arr);
print_r($arr);
$hijo = $arr['Object'];
// print_r($hijo);

$response = json_encode($hijo);

printf("%s\n", $response);
if (openssl_verify($response, base64_decode($arr['Signature']), $cert, OPENSSL_ALGO_SHA512)) {
    echo "\nListo 1 !!\n\n";
    exit;
} else {
    echo "\nMierda 1 !\n\n";
}

$response = str_replace('\/', '/', json_encode($hijo));
printf("%s\n", $response);
if (openssl_verify($response, base64_decode($arr['Signature']), $cert, OPENSSL_ALGO_SHA512)) {
    echo "\nListo 2 !!\n\n";
    exit;
} else {
    echo "\nMierda 2 !\n\n";
}

$response = str_replace('\\u00f3', 'ó', $response);
printf("%s\n", $response);
if (openssl_verify($response, base64_decode($arr['Signature']), $cert, OPENSSL_ALGO_SHA512)) {
    echo "\nListo 3 !!\n\n";
    exit;
} else {
    echo "\nMierda 3 !\n\n";
}

// printf("Firma: %s\n", $arr['Signature']);

function ksortRecursive(&$array, $sort_flags = SORT_REGULAR)
{
    if (!is_array($array)) {
        return false;
    }
    ksort($array, $sort_flags);
    foreach ($array as &$arr) {
        ksortRecursive($arr, $sort_flags);
    }
    return true;
}

?>
