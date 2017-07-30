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

$mensaje = '{"Object":{"Object":{"SessionId":"ad04867aff5a4ceaac49dbede32b880b","Client":"Sodexo","Action":3,"PaymentInstrument":{"InstrumentToken":"294a044a98f94aecbb6a535c103b8e55","Name":"510510XXXXXX5100","Issuer":{"Id":"4","Issuer":"MasterCard","Bank":null,"Variation":null,"ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/4.png"},"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$","MercuryId":0},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S","MercuryId":1}],"Status":0,"InstrumentExpirationUTC":1517356800,"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}]},"OptionalMetadata":null},"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","UTCUnixTimeExpiration":1501204741},"Signature":"RoclQNi7bjtP38JzBL5nPBCB/RTYQiE0DxpEC1mm8qpCAD9w8ErHuvfo4fnzgH0ug3aom0o7w4/I0M36PHJRnAKIovTy3/QOub34iOBHJbO3qK9xnkPiXT3j+UpvyEhVsMxm340buYldGI+6C60l+r26ZH3ahOhGa/PJisZii7BMo/IybVnU7ZLIf0VzF0rIW8+JixEpC59YjwlbkaRmzUgR0xguuB9SsbhK6c/8L/NadthlnOt5YnlyvByVqWA/6p+jYpFqxJlKVe4GgKBAe3p+/u8S1Qf/QtyHAoRp76YZXeaCZ1+TraU0AfUk6I1QtJf+mj5TjD3CrCSjm/bpY0DmUBYcUORH+lE00tt0FpqGZH2yEMEqLkB4OhKt+a7DnV4lf78Xs9YVdJNbVGdlKkP8Y7Cq4EOVCv5k53ffK6T0phQOHTYQ4pLSyqBPz3JLSDb/kFaCBk8EEBacFN0Jdi8ERUnQDB6UBOssFIIH8ZJSMQRvN0zIyV5lsK58Ja6zHGo6bjMP1N0zV9Iycm+muDPpYB6RFvquQ4n1E5y8vIar09tvB3X8vfFdBK4KtMLChGlgZ223SUJYjQiIrvVdWrPhkT2LHJyxAFbWMNi2+hli832xWp2m0ROi3mMuCIEpzTys6vyVMAlpnikx0tXa51iE3ZDZYiXxgfYaLPBI0ug="}';
//$arr = json_decode($mensaje);

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

// ksort($arr['Object'], SORT_REGULAR);
ksortRecursive($arr);
//print_r($arr);

$operaciones = [
    function($arr) {
        echo "FILTER\n";
        return array_filter($arr);
    },
];
$remplazos = [
    function($str) {
        return str_replace('\/', '/', $str);
    },
//    function($str) {
//        return str_replace('\\u00f3', 'ó', $str);
//    },
    function($str) {
        return str_replace('"OptionalMetadata":null,', '', $str);
    },
//    function($str) {
//        return str_replace('"CreditLimits":[],', '', $str);
//    },
    function($str) {
        return str_replace('"Bank":null,', '', $str);
    },
    function($str) {
        return str_replace(',"Variation":null', '', $str);
    },
//    function($str) {
//        return str_replace('"Id":"11"', '"Id":11', $str);
//    },
//    function($str) {
//        return str_replace('"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}],', '', $str);
//    },
//    function($str) {
//        $str = str_replace(',"SupportedCurrencies":[{"CurrencyId":1,"MercuryId":0,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"MercuryId":1,"Name":"D\u00f3lar","Plural":"D\u00f3lares","Symbol":"U$S"}]', '', $str);
//        return str_replace(',"SupportedCurrencies":[{"CurrencyId":1,"MercuryId":0,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"MercuryId":1,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}]', '', $str);
//    },
];

function combinaciones($str, $responses, $camino) {
    global $remplazos;
    for ($i = 0; $i < count($remplazos); $i++) {
        if (in_array($i, $camino)) {
            continue;
        }
        $func = $remplazos[$i];
        $response = $func($str);
        $nuevo_camino = $camino;
        array_push($nuevo_camino, $i);
        $responses = combinaciones($response, $responses, $nuevo_camino);
    }
    if (!in_array($str, $responses)) {
//        printf("%s\n%s\n\n", $str, print_r($camino, true));
        array_push($responses, $str);
    }
    return $responses;
}

$response = json_encode($arr['Object']);
echo $response."\n\n";
$response = str_replace('\/', '/', $response);
echo $response."\n\n";
$response = str_replace('\\u00f3', 'ó', $response);
echo $response."\n\n";
$response = str_replace('"OptionalMetadata":null,', '', $response);
echo $response."\n\n";
$response = str_replace('"Bank":null,', '', $response);
echo $response."\n\n";
$response = str_replace(',"Variation":null', '', $response);
echo $response."\n\n";
//$responses = combinaciones($response, array(), array());
//print_r($responses);

exit;
//$hijo = $arr['Object'];
// print_r($hijo);

// $response = json_encode($hijo);

$mierdas = 0;
printf("Respuestas: %d\n", count($responses));
foreach ($responses as $response) {

    printf("%s\n", $response);
    if (!json_decode($response)) {
        echo "json inválido\n";
        exit;
    }
    if (openssl_verify($response, base64_decode($arr['Signature']), $cert, OPENSSL_ALGO_SHA512)) {
        echo "\nListo 1 !!\n\n";
        exit;
    } else {
//        printf("\nMierda %d !\n\n", ++$mierdas);
    }
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

// {"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","Object":{"Action":3,"Client":"Sodexo","OptionalMetadata":null,"PaymentInstrument":{"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}],"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"InstrumentExpiration":"2018-01-31T03:00:00Z","InstrumentToken":"b0c67aec63584b34afe18dddf5bc1d23","Issuer":{"Bank":null,"Id":"11","ImageUrl":"http:\/\/209.133.212.155\/plexoweb\/images\/instruments\/11.png","Issuer":"Visa","Variation":null},"Name":"411111XX1111","Status":0,"SupportedCurrencies":[{"CurrencyId":1,"MercuryId":0,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"MercuryId":1,"Name":"D\u00f3lar","Plural":"D\u00f3lares","Symbol":"U$S"}]},"SessionId":"b005dea3803a4ebc813b4b14547a02e2"},"UTCUnixTimeExpiration":1500926006}

?>

