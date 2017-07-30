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

//$mensaje = '{"Object":{"Object":{"SessionId":"e285556f8bd14e7c8b10332fc8abf63a","Client":"Sodexo","Action":3,"PaymentInstrument":{"InstrumentToken":"28876eeddbef455ea4d627caaea5dbd4","Name":"411111XX1111","Issuer":{"Id":"11","Issuer":"Visa","Bank":null,"Variation":null,"ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/11.png"},"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}],"Status":0,"InstrumentExpirationUTC":1517356800,"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}]},"OptionalMetadata":null},"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","UTCUnixTimeExpiration":1501264741},"Signature":"IFa3zsAM58S00M018SPqsltthIVQbl2JT/sP2JMJ5gac+uq8rchDUB7Hsaou+k+2o3ZIkNh2RUeP6zXmCnEU1pTBYulVcG65ylK5SY0d+L56qgmaU7P3cZRovrKkDwLFy9A9EDRDUPcXCMbq2sMw2f1YHB6I8ToKG5J4hbEZV+xaikb/iPtLCSbzuU4ku9AA8bz0ICvWjBVK5mBmXmebBwdLioQP/jeQuEcUXbXEEh2OhEKs2RCrxQImVqA5P4JpbbFs4egESuz7ne6alA25v1OWxCXEnXOdTSZBJso4o2Wc2kMx2hU9htqYyLZDN4G7tYhSc43JqkEBKo1zXSJCMfDFang3GMyX9u3mpSOakBoRlXL37mEy2F7cmLxiI6K5MDSn6uE/KlPodC48VjvcqCjFpq67yfp3exBUOTiPFe3IecJdxWr3ELH6jMx9H8Zvww6l1Nn7+QN+3Pa1o0MCeyLSj0Zqvc7Xenho3NdIl2/Yyr+13HAV5FHeFpQ/nIk3yjPIU9hqaOFRMtGa1h/3NbrQk1Wqej8Y1sVt5WLh8Qgv1TtLrrHtLXFYseIOMpev7P6IYkx/8uq506OZf2I8xNkBuum9kaKX3lm7xG5lSLEBywAXWHUervnTL6yKR4s1eL9fOiXUK2GyKJ+iWuUxXLAifjXDL7XjatvBZIR1iNM="}';
$mensaje = '{"Object":{"Object":{"SessionId":"29912889b07944f4b40914821def8d3a","Client":"Sodexo","Action":3,"PaymentInstrument":{"InstrumentToken":"bc081baefb9949289a312a05de6948bc","Name":"555555XXXXXX4444","Issuer":{"Id":"4","Issuer":"MasterCard","Bank":null,"Variation":null,"ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/4.png"},"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}],"Status":0,"InstrumentExpirationUTC":1517356800,"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}]},"OptionalMetadata":null},"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","UTCUnixTimeExpiration":1501265227},"Signature":"Xf9hI9I++7ff7SMgoGnYZR4/rMEx6klIQm9dIDGgg5yem169eF2eb2hb4VBnu92bC29eI2iGZY+0eEj7R+pGeGcAo0PoTNj5weicL2nVaTFfe4BEvl5bXuzp8w7hsAA8CERNuYf+Ja2sWuIu/pjtiP0tZBJHtuyzSGKDXkdbuYJRe1u/ATX4cd0n3/U24E+JABzbvfH86yQbTouWB4BtaVycPME2gZ2CL3iMg2CRBFb+bWlrxmluSYmnZhE5syH8RBnS7bx9np7EU5TSWg7C8J3/tO1EXkCtdAckbPVUisRW5/yShtJBvR9+v06ipcHFOIYqoMuTf1Xzf7MIu6ARFfyBnr4n7HQw76u/TKxdXtim8DHUWOahnNSwt16K8Ndch5dZG5f7sTI1v2R54TeEfhw2cqhZHF52zbcMymdU2ylAtBehMYqbRdpbxzC0d3W7toA33D6y5eF6TAfl9ldrDpBSj9tEwBZGPBX3F7183/2cFVlgYl+9QSQm/rzN2dxQUFHwrnHJt6WU6oGJsqnWpJbnD+xXJnEWUFzrjcwAQT3z+MiFTYEPTvrEwgOYBjslfTbpeusqBIa2IqRSjirwDkjIFBDMe0OxZThjSF9IyrsHKDpkVNpiBRL7J38BGGgkz/BA2fNPOJOiUNFeCzx2RhRPRQh+wQ/PMN3v1LUg7zA="}';

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
Plexo\Sdk\utilities\functions\ksortRecursive($arr);
//print_r($arr);

$operaciones = [
    function($arr) {
        echo "FILTER\n";
        return array_filter($arr);
    },
];
$remplazos = [
//    function($str) {
//        return str_replace('\/', '/', $str);
//    },
    function($str) {
    echo '\\\\u00';
        return preg_replace_callback('/\\\\u(00f3)/', function ($coincidencias) {
            var_dump($coincidencias);
            return 'XXXX';
        }, $str);
////        return str_replace('\\u00f3', 'ó', $str);
    },
//    function($str) {
//        return str_replace('"OptionalMetadata":null,', '', $str);
//    },
//    function($str) {
//        return str_replace('"Bank":null,', '', $str);
//    },
//    function($str) {
//        return str_replace(',"Variation":null', '', $str);
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

printf("%s\n\n", $response);

$responses = combinaciones($response, array(), array());
//print_r($responses);

//$hijo = $arr['Object'];
// print_r($hijo);

// $response = json_encode($hijo);

//$mierdas = 0;
printf("Respuestas: %d\n", count($responses));

foreach ($responses as $response) {
    printf("%s\n\n", $response);
    if (!json_decode($response)) {
        echo "json inválido\n";
        exit;
    }
    if (openssl_verify($response, base64_decode($arr['Signature']), $cert, OPENSSL_ALGO_SHA512)) {
        echo "\nListo 1 !!\n\n";
        exit;
    } else {
    //        printf("\nMierda %d !\n\n", ++$mierdas);
//        printf(".");
    }
}

// printf("Firma: %s\n", $arr['Signature']);

//{"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","Object":{"Action":3,"Client":"Sodexo","PaymentInstrument":{"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}],"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"InstrumentExpirationUTC":1517356800,"InstrumentToken":"bc081baefb9949289a312a05de6948bc","Issuer":{"Id":"4","ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/4.png","Issuer":"MasterCard","Bank":null,"Variation":null},"Name":"555555XXXXXX4444","SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}],"Status":0},"OptionalMetadata":null,"SessionId":"29912889b07944f4b40914821def8d3a"},"UTCUnixTimeExpiration":1501265227}
//{"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","Object":{"Action":3,"Client":"Sodexo","PaymentInstrument":{"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}],"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"InstrumentExpirationUTC":1517356800,"InstrumentToken":"bc081baefb9949289a312a05de6948bc","Issuer":{"Id":"4","ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/4.png","Issuer":"MasterCard"                             },"Name":"555555XXXXXX4444","SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}],"Status":0},                        "SessionId":"29912889b07944f4b40914821def8d3a"},"UTCUnixTimeExpiration":1501265227}

?>

