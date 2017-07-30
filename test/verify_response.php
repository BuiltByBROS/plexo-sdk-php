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
-----END CERTIFICATE-----';


/**
 * $certs = Array(
 *      [cert] => -----BEGIN CERTIFICATE-----...
 *      [pkey] => -----BEGIN PRIVATE KEY-----...
 * )
 */

//$arr = [
//    "Object" => [
//        "Fingerprint" => "AEA4D5C586983A140F8B566EA81901E8BD8F8C9F",
//        "Object" => [
//            "Response" => [
//                "Fingerprint" => "AEA4D5C586983A140F8B566EA81901E8BD8F8C9F",
//                "Key" => "MIIEqjCCApKgAwIBAgIQAJWa99PYfAz1RXGI9lIkQzANBgkqhkiG9w0BAQ0FADAQMQ4wDAYDVQQDDAVQbGV4bzAgFw0xNzAzMDcxMDIzMzlaGA8yMTE3MDMwNzEwMjMzOVowEDEOMAwGA1UEAwwFUGxleG8wggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQCxjCJAfz23Wq2TiskCzgSc/bHYChXF47lu3u1KfEy/lSY0i+6e3nPFTOkXd6Uh5MWh+icwpwxd+h6rKgS82aswq9gCCFu/FQksdAsWOHzBuS6sH+1rKNC0zh0DPjxuMPEvgMfJcOm5ciqdJSrgH1VLG9X32HsQCAjIvWh/IgUia+E5HJf1xnatgme0q75fShZexl3v4rj2mbuxrFXBDgdPDsCp/a0TQu5o8JpU3+G1cpWYhpJeMT/LCnUsEM12xDldfJeqdKlMPT3fwWLznxKTcvLXuDyqwjt5IADCoJ3EFjo8/BN4ZkvZqxmOxeutDNib229BcWz0loQTfe24hhX9yXk+ANHx5lJDCh0rMv2ZVe3Gt+G3faJNK89kPcjx2MTjpO7hp61GMcObL3TaBly4rRW4BZJOIXjm59/V4XWz730O5RX7G0Rx4RLf7kI6fFXIWdqdoQQqI7Jm7A61bI0Lv8oWKY084+vZ3GjwSF5p/SVU1/wVOuYilYR7nfrCllat6PA+NeyNN4U1AfNpRtR3uJWo/GLlD7VUAVsGbIDLTRrMautH2z0HykzIdE/w9gLkBiQLQgzy3WpwF1aj9758iS0S5tf4HOwXW8BiMFPQDs64nbs7ECsi7EbCIhJpJl16mw0ucR0VrDJsXbZInIbw+/XNNxX3eeH1SQO+tmjeyQIDAQABMA0GCSqGSIb3DQEBDQUAA4ICAQBVwEvKy+s3BNaNfIc/nPp9E7O4fnJKQuvIDpAJkcAtu51UAvHUkma08SoiJiPzG5K1lx4A3nZEy/dvcYsv9MbmAJCsYUlNQ4vcjtz4xdBsTvEv5KS5MjYL2auuTlNuFf1zogsZnxG+aJ9gup9U2L3h6r2mKccjdP9HC4ZnZ/qEk+Gp4quGnDTIm8jq7R3qDs/f4/zfGyTZewTcwztoMS7dxiFM9IzCeWmpdGtUv0DEK8K4ocfNXfXK6Hw6GfCqC7KVab9OUOcR+cn3ArB71QyuVNXn20bpK2GiSOpQ/8ICoRh6FbXbRfhD8NqsU5HDqed3+MuBWM5J1CACtyjP2L74YMGvR7PbZz9TsNYE37eLEzduuLqSCaolYEAa/gJirsal9cyngpqEStDkr0xMsi2fXxdSUArHDj+ftOfrdFFNP1HBEGLXJkNY1w3TUFgkwVOhxr/6BNjDjDkSVcUUBG1VvoDHLhl5l/jLLoBy6tEAApg/MtirNqE9YtZuqN3b6BNx2kYAAnrKofxxntNr2LYoKnXCi2ETXgmYObVkB9Tvdn6zmtJBTYozh64KYvhmFw48CC2TKzmlLT2jdHP4R375WFcIHvFzyu8B/SMxItc8nLC7JoyX162zF1Ci8B2RtQL937QT7M62o6XVHo05SPyorrcA8L/Xtqfz+eVmafF/Mg=="
//            ],
//            "ResultCode" => 0
//        ],
//        "UTCUnixTimeExpiration" => 1500664791
//    ],
//    "Signature" => "WyEdu3s0QTKMW8byurvSno93GTsghI4ftPPMkU5FE7X4rtcT+BdpCFb0hjUz+2q0o6w/T+oTfvZjbfd5ylypfih0g2N5dT3RlOlliu34P0tepzZVP4BKIVf7t7qDvY56fKlYMBtJW85z8FjWADoEUsnRlOaW6x7+3CIkGAnQWbR99gXAd6V+Oz5p7t/xYkgc8/WoHvCbS925NcBe9RIGnx8WR5kSHTKIFQh6uynZO2pnR/VEaCWk33DZJ2xYfZNutbb+hn/QN4W5apKRoMgnHacSeXZ7bPOvs8vyvGXFcsOAREZJJCkIWnV9LZ9z+A7Z/DZpuNX76M4JPIV/CtAXg6sqjQQsow48DFh33ayEKhfHIjKTuh17wRxOnEC46j+779oxTmKgH8VAqf0dQbYO03+xOZWUIgGMYoeINQfqsuQ/0eyQJAFDMyQd8p0eFsoj+LHvmOWnsgj+82pJlnFBx2HHuuYDlE6QqqJ1enGow374UwVp5l509CcCm2tQOtZ7dawSH1QDI4jwaivMwWOkZwWJCQlbytI3Kl1uqhCE60SLzIiu6t1UqUrLW7pumP/TCDHW1wQCCKlY4OaQGCUaPgtPmxwom64evxQSX7OlmIwvRrypVgr9gg17RFz+YEpQB2ZKX6dBnYS7Cc03brxC953k5nFt4Rbwpg1KaPS1JM0="
//];
//$signature = 'WyEdu3s0QTKMW8byurvSno93GTsghI4ftPPMkU5FE7X4rtcT+BdpCFb0hjUz+2q0o6w/T+oTfvZjbfd5ylypfih0g2N5dT3RlOlliu34P0tepzZVP4BKIVf7t7qDvY56fKlYMBtJW85z8FjWADoEUsnRlOaW6x7+3CIkGAnQWbR99gXAd6V+Oz5p7t/xYkgc8/WoHvCbS925NcBe9RIGnx8WR5kSHTKIFQh6uynZO2pnR/VEaCWk33DZJ2xYfZNutbb+hn/QN4W5apKRoMgnHacSeXZ7bPOvs8vyvGXFcsOAREZJJCkIWnV9LZ9z+A7Z/DZpuNX76M4JPIV/CtAXg6sqjQQsow48DFh33ayEKhfHIjKTuh17wRxOnEC46j+779oxTmKgH8VAqf0dQbYO03+xOZWUIgGMYoeINQfqsuQ/0eyQJAFDMyQd8p0eFsoj+LHvmOWnsgj+82pJlnFBx2HHuuYDlE6QqqJ1enGow374UwVp5l509CcCm2tQOtZ7dawSH1QDI4jwaivMwWOkZwWJCQlbytI3Kl1uqhCE60SLzIiu6t1UqUrLW7pumP/TCDHW1wQCCKlY4OaQGCUaPgtPmxwom64evxQSX7OlmIwvRrypVgr9gg17RFz+YEpQB2ZKX6dBnYS7Cc03brxC953k5nFt4Rbwpg1KaPS1JM0=';

$arr = [
    "Object" => [
        "Object" => [
            "ErrorMessage" => "Unable to find certificate for client 'sodexo27042017'",
            "ResultCode" => 7,
        ],
        "Fingerprint" => "AEA4D5C586983A140F8B566EA81901E8BD8F8C9F",
        "UTCUnixTimeExpiration" => 1500678843,
    ],
    "Signature" => "kDgj4VNcQFtREw0irjQ2eesKnfTMk5+CzlxVOHtizjYexmudpXxg9Nie+JKozTvvRaD/NXI0ruCpGxV0dTHkhjeCi04IHgpexIAa2FWuDosXCD1vXmCy9/nlEFaU7zlfKn2KV7Yfb6utSMsxslJzRTdd7bW1YRYl69WHi/fveIJSgPw97gFmB9O58PqKVpuejt5pa2wiU+4iR09oTBsw4Msh5iVfUvSZjhDQJ5IuWDaA9qvzlbfVFf9L15nCxGARz0AMtupS0V/qBzI+/kXGOOcvQIq/VVixhGXGb1rtbosCqfn4nDNm3SWVKFSHW/Jm3Mv61VPz4de4F/vkd2ZiY/oSeCpxopy51dQvQkyY/yLmI72e3J9vlbO4spCJLEq79pd+nU0PF8fTO8myCPamVY2DVJ/IDFt9HQ3++F+9ToaHN4WqCG3I1P6XDYc6WUyID00etJfrEX82yO2PzK+ir4/OGhi1vRBl/SufFL+1IBrVxH2gydSBvec2/+Fw97ctwj8ptYZ7vF4vs8kU4rbMN7yv10LBnspGV94dls2Fl6D5JTG95wZI7YMa+Tqz+rSVeMlspiHloKSDKME50PcE/t4wMKlZ9QLmHLi32OWHJKZNxWcA5vHggRSpzN9Q6WcP/h2bBACqqCeN/ECNtDF4UW+HsImYLYWrFdsq3pWPuPg="
];

ksort($arr['Object'], SORT_REGULAR);
$hijo = $arr['Object'];
print_r($hijo);
$response = str_replace('\/', '/', json_encode($hijo));

//openssl_sign($payload_str, $signature, $certs['pkey'], OPENSSL_ALGO_SHA512);
//$signature = base64_encode($signature);
//echo $signature."\n";

printf("%s\n", $response);
print_r(json_decode($response));
if (openssl_verify($response, base64_decode($arr['Signature']), $cert, OPENSSL_ALGO_SHA512)) {
    echo "Listo!!\n";
    exit;
}

?>

