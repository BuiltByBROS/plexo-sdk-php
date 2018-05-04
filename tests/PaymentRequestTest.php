<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class PaymentRequestTest extends TestCase
{
    public function setUp()
    {
        $paymentRequestData = [
            'ClientReferenceId' => '12345',
            'CurrencyId' => Type\CurrencyType::UYU,
            'FinancialInclusion' => [
                'Type' => Type\InclusionType::NONE,
                'BilledAmount' => 123,
                'InvoiceNumber' => 123456,
                'TaxedAmount' => 123.123,
            ],
            'Installments' => 3,
            'Items' => [
                [
                    'Amount' => 321.123,
                    'ClientItemReferenceId' => '12345',
                ],
                [
                    'Amount' => 321.012,
                    'ClientItemReferenceId' => '23456',
                ],
                [
                    'Amount' => 321.1,
                    'ClientItemReferenceId' => '34567',
                ],
            ],
            'PaymentInstrumentInput' => [
                'InstrumentToken' => '0123456789ABCDEF0123456789ABCDEF',
                'UseExtendedClientCreditIfAvailable' => true,
                'OptionalCommerceId' => 42,
                'NonStorableItems' => [
                    'Name' => 'Nombre',
                    Type\FieldType::EMAIL => 'mail@example.net',
                    new Type\FieldType(Type\FieldType::FIRST_NAME, 'Pepe'),
                ],
            ],
        ];
    }

    public function testCanBeCreatedFromArray()
    {
        $paymentRequest = Models\PaymentRequest::fromArray($paymentRequestData);
        $this->assertInstanceOf(
            Models\PaymentRequest::class,
            $paymentRequest
        );
var_dump($paymentRequest);
//var_dump($paymentRequest->validate());
        return $paymentRequest;
    }

    public function testValues($paymentRequest)
    {
        $this->assertSame($expected, $actual)
    }

    /**
     * @depends testCanBeCreatedFromValidArray
     */
    public function _testSignatureBaseString($paymentRequest)
    {
        $signedRequest = new SignedRequest($paymentRequest);
        $signedRequest->setClient('Prueba');
        $this->assertSame(
            '{'.
              '"Fingerprint":"",'.
              '"Object":{'.
                '"Client":"Prueba",'.
                '"Request":{'.
                  '"ClientReferenceId":"12345",'.
                  '"CurrencyId":1,'.
                  '"FinancialInclusion":{'.
                    '"BilledAmount":123.0,'.
                    '"InvoiceNumber":123456,'.
                    '"TaxedAmount":123.123,'.
                    '"Type":0'.
                  '},'.
                  '"Installments":3,'.
                  '"Items":['.
                    '{"Amount":321.123,"ClientItemReferenceId":"12345"},'.
                    '{"Amount":321.012,"ClientItemReferenceId":"23456"},'.
                    '{"Amount":321.1,"ClientItemReferenceId":"34567"}'.
                  '],'.
                  '"PaymentInstrumentInput":{'.
                    '"InstrumentToken":"0123456789ABCDEF0123456789ABCDEF",'.
                    '"NonStorableItems":{"Email":"mail@example.net","FirstName":"Pepe","Name":"Nombre"},'.
                    '"UseExtendedClientCreditIfAvailable":true'.
                  '}'.
                '}'.
              '},'.
              '"UTCUnixTimeExpiration":null'.
            '}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testImplementsArrayAccess()
    {
        $paymentRequest = new Models\PaymentRequest();
        $paymentRequest['CurrencyId'] = Type\CurrencyType::USD;
        $this->assertSame(Type\CurrencyType::USD, $paymentRequest['CurrencyId']);
    }

    public function testSetters()
    {
        $paymentRequest = new Models\PaymentRequest();
        $paymentRequest->CurrencyId = Type\CurrencyType::USD;
        $this->assertSame(Type\CurrencyType::USD, $paymentRequest['CurrencyId']);
        $this->assertSame(Type\CurrencyType::USD, $paymentRequest->CurrencyId);
    }

    public function testHasDefaults()
    {
        $paymentRequest = new Models\PaymentRequest();
        $this->assertSame(0, $paymentRequest['Installments']);
        $this->assertSame(Type\CurrencyType::UYU, $paymentRequest['CurrencyId']);
    }

    /**
     * @var expectedException Plexo\Sdk\Exception\InvalidArgumentException
     */
    public function testMustHaveInstallments()
    {
        $paymentRequest = Models\PaymentRequest::fromArray([
            'Installments' => null,
            'Items' => [
                [
                    'Amount' => 100.0,
                    'ClientItemReferenceId' => '12345',
                ],
            ],
            'PaymentInstrumentInput' => [
                'InstrumentToken' => '919B3143797E4032BD8134E85B2DE1F5',
            ],
        ]);
        $this->assertArraySubset([[
            'class' => 'Plexo\Sdk\Models\PaymentRequest',
            'error' => 'Installments cannot be empty',
        ]], $paymentRequest->validate());
    }

    /**
     * @expectedException Plexo\Sdk\Exception\InvalidArgumentException
     */
    public function testMustHaveItems()
    {
        $paymentRequest = Models\PaymentRequest::fromArray([
            'PaymentInstrumentInput' => [
                'InstrumentToken' => '919B3143797E4032BD8134E85B2DE1F5',
                'UseExtendedClientCreditIfAvailable' => true,
                'OptionalCommerceId' => 48,
            ],
        ]);
        $paymentRequest->toArray(true);
    }

    /**
     * @expectedException Plexo\Sdk\Exception\InvalidArgumentException
     */
    public function testMustHavePaymentInstrumentInput()
    {
        $paymentRequest = Models\PaymentRequest::fromArray([
            'Items' => [
                [
                    'Amount' => 100.0,
                    'ClientItemReferenceId' => '12345',
                ],
            ],
        ]);
        $paymentRequest->toArray(true);
    }
}
