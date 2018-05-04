<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class PaymentRequestTest extends TestCase
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

//    public function testCanBeCreatedFromArray()
//    {
//        $issuerData = Models\IssuerData::fromArray($this->dataArray);
//        $this->assertInstanceOf(Models\IssuerData::class, $issuerData);
//    }

    public function testIssuerIdCoercion()
    {
        $issuerData = new Models\IssuerData();
        $issuerData->IssuerId = 1;
        $this->assertSame(1, $issuerData->IssuerId);
        $this->assertSame(1, $issuerData['IssuerId']);
        $issuerData->IssuerId = '2';
        $this->assertSame(2, $issuerData->IssuerId);
        $this->assertSame(2, $issuerData['IssuerId']);
        
//        $issuerData->setIssuerId('2');
//        $this->assertSame(4, $issuerData->IssuerId);
    }

}
