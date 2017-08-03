<?php

require_once 'vendor/autoload.php';

use Plexo\Sdk;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Content-Type: text/plain; charset=UTF-8");
    header("Allow: POST", true, 405);
    echo "Method Not Allowed.\n";
    exit;
}

$fp = fopen("php://input", "r");
$data = '';
while(!feof($fp)) {
    $data .= fgets($fp);
}
fclose($fp);


$pub_cert = '-----BEGIN CERTIFICATE-----
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

$cert = new Sdk\Certificate\Certificate($pub_cert);
$priv = Sdk\Certificate\Certificate::fromPfxFile('/home/dh_3xq9zd/sodexo27042017.pfx', 'sodexotest');

$signedRequest = Sdk\SignedRequest::fromJson($data);
var_dump($signedRequest, $signedRequest->getMessage());
try {
    $signedRequest->validate($cert);
    $signedResponse = new Sdk\SignedResponse([
        'Client' => "Sodexo",
        'ResultCode' => 0,
    ]);
} catch (Sdk\PlexoException $exc) {
    $signedResponse = new Sdk\SignedResponse([
        'Client' => "Sodexo",
        'ResultCode' => 0,
    ]);
} catch (\Exception $exc) {
    echo "NO ES VÁLIDO\n";
    var_dump($exc);
}

$signedResponse->sign($priv);

header("Content-Type: application/json; charset=UTF-8");
echo $signedResponse

?>
