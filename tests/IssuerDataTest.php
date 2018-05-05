<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class IssuerDataTest extends TestCase
{
    public function setUp()
    {
        $this->dataArray = [
            'IssuerId' => 4,
            'CommerceId' => 39,
            'Metadata' => [
                'ProviderCommerceNumber' => '20000012',
            ]
        ];
    }

    public function testGetSet()
    {
        $issuerData = new Models\IssuerData();

        $issuerData->IssuerId = 1;
        $this->assertSame(1, $issuerData->IssuerId);
        $this->assertSame(1, $issuerData['IssuerId']);
        
        $issuerData->IssuerId = 2;
        $this->assertSame(2, $issuerData->IssuerId);
        $this->assertSame(2, $issuerData['IssuerId']);
    }

    public function testIssuerIdCoercion()
    {
        $issuerData = Models\IssuerData::fromArray($this->dataArray);
        $signedRequest = new SignedRequest($issuerData);
        $signedRequest->setClient('Prueba');

        $issuerData->IssuerId = '1';
        $issuerData->validate();
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"CommerceId":39,"IssuerId":1,"Metadata":{"ProviderCommerceNumber":"20000012"}}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
