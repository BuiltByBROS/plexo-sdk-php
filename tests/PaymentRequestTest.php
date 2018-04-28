<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class PaymentRequestTest extends TestCase
{
    public function testCanBeCreatedFromValidArray()
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
        $paymentRequest = Models\PaymentRequest::fromArray($paymentRequestData);
        $this->assertInstanceOf(
            Models\PaymentRequest::class,
            $paymentRequest
        );
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
}
