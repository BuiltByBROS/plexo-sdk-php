<?php
namespace Plexo\Sdk\Type;

class FieldType {
    //User Generic Information
    const PAN                          =    0;
    const EXPIRATION                   =    1;
    const PIN                          =    2;
    const CVC                          =    3;
    const NAME                         =    4;
    const ADDRESS                      =    5;
    const ZIP_CODE                     =    6;
    const EMAIL                        =    7;
    const PHONE                        =    8;
    const CELLPHONE                    =    9;
    const AMOUNT_LIMIT_EXTENSION       =   10;
    const BIRTHDATE                    =   11;
    const INSTRUMENT_NAME              =   12;
    const IDENTIFICATION_TYPE          =   13;// 0 - CI ; 1 - Pasaport; 3 Otros
    const IDENTIFICATION               =   14;
    const IDENTIFICATION_TYPE_EXTENDED =   15;// 0 - CI ; 1 - Pasaport; 3 Otros; 4 RUT

    //Provider Related Information starts at 1000
    const PROVIDER                     = 1000;

    //Commerce Related Information starts at 2000
    const PROVIDER_COMMERCE_NUMBER     = 2000;
    const OCA_TAXI_CODE                = 2001;

    //User/Provider Related Information starts at 3000
    const SISTARBANK_PAYMENT_METHOD    = 3000;
    const REDPAGOS_PRODUCT_NUMBER      = 3001;
}
