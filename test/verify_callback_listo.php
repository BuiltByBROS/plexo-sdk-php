<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;

//$mensaje = '{"Object":{"Object":{"SessionId":"e285556f8bd14e7c8b10332fc8abf63a","Client":"Sodexo","Action":3,"PaymentInstrument":{"InstrumentToken":"28876eeddbef455ea4d627caaea5dbd4","Name":"411111XX1111","Issuer":{"Id":"11","Issuer":"Visa","Bank":null,"Variation":null,"ImageUrl":"http://209.133.212.155/plexoweb/images/instruments/11.png"},"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}],"Status":0,"InstrumentExpirationUTC":1517356800,"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}]},"OptionalMetadata":null},"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","UTCUnixTimeExpiration":1501264741},"Signature":"IFa3zsAM58S00M018SPqsltthIVQbl2JT/sP2JMJ5gac+uq8rchDUB7Hsaou+k+2o3ZIkNh2RUeP6zXmCnEU1pTBYulVcG65ylK5SY0d+L56qgmaU7P3cZRovrKkDwLFy9A9EDRDUPcXCMbq2sMw2f1YHB6I8ToKG5J4hbEZV+xaikb/iPtLCSbzuU4ku9AA8bz0ICvWjBVK5mBmXmebBwdLioQP/jeQuEcUXbXEEh2OhEKs2RCrxQImVqA5P4JpbbFs4egESuz7ne6alA25v1OWxCXEnXOdTSZBJso4o2Wc2kMx2hU9htqYyLZDN4G7tYhSc43JqkEBKo1zXSJCMfDFang3GMyX9u3mpSOakBoRlXL37mEy2F7cmLxiI6K5MDSn6uE/KlPodC48VjvcqCjFpq67yfp3exBUOTiPFe3IecJdxWr3ELH6jMx9H8Zvww6l1Nn7+QN+3Pa1o0MCeyLSj0Zqvc7Xenho3NdIl2/Yyr+13HAV5FHeFpQ/nIk3yjPIU9hqaOFRMtGa1h/3NbrQk1Wqej8Y1sVt5WLh8Qgv1TtLrrHtLXFYseIOMpev7P6IYkx/8uq506OZf2I8xNkBuum9kaKX3lm7xG5lSLEBywAXWHUervnTL6yKR4s1eL9fOiXUK2GyKJ+iWuUxXLAifjXDL7XjatvBZIR1iNM="}';
$mensaje = '{"Object":{"Fingerprint":"AEA4D5C586983A140F8B566EA81901E8BD8F8C9F","UTCUnixTimeExpiration":1501451783,"Object":{"Action":3,"Client":"Sodexo","OptionalMetadata":null,"PaymentInstrument":{"AdditionalRequirements":[{"RequirementAfterTimeLimit":0,"SecondsLeft":0},{"RequirementAfterTimeLimit":1,"SecondsLeft":0}],"AnonInstrumentUsageTimeLimit":86400,"CreditLimits":[],"InstrumentExpirationUTC":1517356800,"InstrumentToken":"8d3b7fa6c9214aa18b8a99fb8aefe57f","Issuer":{"Bank":null,"Id":"11","ImageUrl":"http:\/\/209.133.212.155\/plexoweb\/images\/instruments\/11.png","Issuer":"Visa","Variation":null},"Name":"411111XX1111","Status":0,"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}]},"SessionId":"49415b3507424cdd81752a507f8265af"}},"Signature":"Gj88uHy4wkjT1nPMma5Fhpdt9RfhJE21owY\/diXRH6+\/dKqUG1gwICucal3JJBAW5IO5X8XFRHSHTz9fNr2ShbDDJI3aldWU\/L3vcZMtdLr7iwsjxsX+OWqh+nv4ibSxreqoOJZzvhDZpbBlBz7IYfA8SZIYIuxNjP9gbk6uQqfKpm2ktDroDx+YPG6YszUod1tHDTNdiNNnMwna1xxNT3P4sIJUW7ZaCSxOgOoEOSKNQXNnCsi69ySpT9kh7SIECdwOj4rC7DUp31Vve+z6o\/CAPeqRgR6BXKOh4NODgbwykdqwdxi3xD3aoK9LPZryFxT62FHridaMNFpUhaeyk+vnZWIBKIXbf3X0UiaPKwyf6jUtzci9W7ayMZl56UAQynuVvzUmke5xuOZKVTpeaE2HZIvAQ2diCtJCs50DwzkJSNIT3YWwe5brwkTl844TaC3ri6cUDI0+cp7gpufkaH25sjiObDeIz8hQxgxncIjBZZSnnDZHKPtAtorHt8FSfdgddr8Ua8Czk2yTw\/81FN15RxY3x+exCHzqgOOPkVxSeqfIieT4nHpFr6X3F\/gvyH0NwvCQON4PEEIgl2ypWALq5sv5Mpz131sciDhyJFq0NONJ59XdVRh3\/PUt1+NTl9jux93TdtNxQ2RkFk\/Vanr8QaR7E2xa8mocb3H+0hI="}';

$arr = json_decode($mensaje, true);
/*
 Array(
    [Object] => Array(
        [Object] => Array(
            [SessionId] => 29912889b07944f4b40914821def8d3a
            [Client] => Sodexo
            [Action] => 3
            [PaymentInstrument] => Array(
                [InstrumentToken] => bc081baefb9949289a312a05de6948bc
                [Name] => 555555XXXXXX4444
                [Issuer] => Array(
                    [Id] => 4
                    [Issuer] => MasterCard
                    [Bank] => 
                    [Variation] => 
                    [ImageUrl] => http://209.133.212.155/plexoweb/images/instruments/4.png
                )
                [SupportedCurrencies] => Array(
                    [0] => Array(
                        [CurrencyId] => 1
                        [Name] => Peso
                        [Plural] => Pesos
                        [Symbol] => $
                    )
                    [1] => Array(
                        [CurrencyId] => 2
                        [Name] => Dólar
                        [Plural] => Dólares
                        [Symbol] => U$S
                    )
                )
                [Status] => 0
                [InstrumentExpirationUTC] => 1517356800
                [AnonInstrumentUsageTimeLimit] => 86400
                [CreditLimits] => Array()
                [AdditionalRequirements] => Array(
                    [0] => Array(
                        [RequirementAfterTimeLimit] => 0
                        [SecondsLeft] => 0
                    )
                    [1] => Array(
                        [RequirementAfterTimeLimit] => 1
                        [SecondsLeft] => 0
                    )
                )
            )
            [OptionalMetadata] => 
        )
        [Fingerprint] => AEA4D5C586983A140F8B566EA81901E8BD8F8C9F
        [UTCUnixTimeExpiration] => 1501265227
    )
    [Signature] => Xf9hI9I++7ff7SMgoGnYZR4/rMEx6klIQm9dIDGgg5yem169eF2eb2hb4VBnu92bC29eI2iGZY+0eEj7R+pGeGcAo0PoTNj5weicL2nVaTFfe4BEvl5bXuzp8w7hsAA8CERNuYf+Ja2sWuIu/pjtiP0tZBJHtuyzSGKDXkdbuYJRe1u/ATX4cd0n3/U24E+JABzbvfH86yQbTouWB4BtaVycPME2gZ2CL3iMg2CRBFb+bWlrxmluSYmnZhE5syH8RBnS7bx9np7EU5TSWg7C8J3/tO1EXkCtdAckbPVUisRW5/yShtJBvR9+v06ipcHFOIYqoMuTf1Xzf7MIu6ARFfyBnr4n7HQw76u/TKxdXtim8DHUWOahnNSwt16K8Ndch5dZG5f7sTI1v2R54TeEfhw2cqhZHF52zbcMymdU2ylAtBehMYqbRdpbxzC0d3W7toA33D6y5eF6TAfl9ldrDpBSj9tEwBZGPBX3F7183/2cFVlgYl+9QSQm/rzN2dxQUFHwrnHJt6WU6oGJsqnWpJbnD+xXJnEWUFzrjcwAQT3z+MiFTYEPTvrEwgOYBjslfTbpeusqBIa2IqRSjirwDkjIFBDMe0OxZThjSF9IyrsHKDpkVNpiBRL7J38BGGgkz/BA2fNPOJOiUNFeCzx2RhRPRQh+wQ/PMN3v1LUg7zA=
)
 */

//print_r($arr);

//Sdk\Registry::get('CertificateProvider');
//$signedRequest = new Plexo\Sdk\SignedRequest($mensaje);

$signedRequest = Plexo\Sdk\SignedRequest::fromJson($mensaje);
try {
    var_dump($signedRequest);
//    $signedRequest->validate(new Sdk\Certificate\Certificate($cert));
    $signedRequest->validate();
    echo "Validó\n";
} catch (Exception $exc) {
    echo "Mierda, no validó " . $exc->getMessage() . "\n";
}

?>
