# Purchase

> public *\\stdClass* **Plexo\\Sdk\\Client::Purchase** ( *array* $payment )

## Parámetros

  * **ClientReferenceId** (string)
  * **CurrencyId** (int) Código de moneda de la compra. Una de las constantes de *Plexo\\Sdk\\Type\\CurrencyType*:
    * UYU (Peso uruguayo)
    * USD (Dólar estadounidense)
    * ARS (Peso argentino)
    * EUR (Euro)
    * BRL (Real)
  * **FinancialInclusion** (FinancialInclusion) Campo para enviar información sobre la Ley de Inclusión Financiera, que contiene:
    * BilledAmount
    * InvoiceNumber
    * TaxedAmount
    * Type
  * **Installments** (int) Cantidad de cuotas
  * **Items** (List<Item>) Es una lista con los ítems de la compra, que contiene los siguientes campos:
    * Amount : monto del item
    * ClientItemReferenceId : ID del item
  * **PaymentInstrumentInput** (PaymentInstrumentInput)
  * **OptionalPointOfSale** *opcional* (string)
  * **OptionalMetadata** *opcional* (string)
