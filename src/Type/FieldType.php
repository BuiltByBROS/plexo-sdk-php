<?php
namespace Plexo\Sdk\Type;

class FieldType {
    // User Generic Information
    const EXPIRATION                   = 0x101;
    const NAME                         = 0x102;
    const ADDRESS                      = 0x103;
    const ZIP_CODE                     = 0x104;
    const EMAIL                        = 0x105;
    const PHONE                        = 0x106;
    const CELLPHONE                    = 0x107;
    const AMOUNT_LIMIT_EXTENSION       = 0x108;
    const BIRTHDATE                    = 0x109;
    const INSTRUMENT_NAME              = 0x10A;
    const IDENTIFICATION               = 0x10B;
    const IDENTIFICATION_TYPE          = 0x10C;
    const IDENTIFICATION_TYPE_EXTENDED = 0x10D;// 0 - CI , 1 - Pasaporte, 3 Otros, 4 RUT
    const ACCOUNT_NUMBER               = 0x10E;// Bank Account Number
    const FIRST_NAME                   = 0x10F;
    const LAST_NAME                    = 0x110;
    const CITY                         = 0x111;

    // Provider Related Information starts at 0x400
    const PROVIDER                     = 0x401;// Example Visa

    // User/Provider Related Information starts at 0x500. User Flag | Provider Flag
    const SISTARBANK_PAYMENT_METHOD    = 0x501;
    const REDPAGOS_PRODUCT_NUMBER      = 0x502;
    const REDPAGOS_USER_ENABLED        = 0x503;

    // Commerce Related Information starts at 0x800
    const PROVIDER_COMMERCE_NUMBER     = 0x801;// This Could be the commerce id (Master/Oca/Visa/Etc)
    const OCA_TAXI_CODE                = 0x802;
    const TERMINAL_NUMBER              = 0x803;
    const POS_NUMBER                   = 0x804;

    // Secure Information Starts at 0x8100. Private Flag | User Flag
    // Secure User Generic Information
    const PAN                          = 0x8101;
    const TOKEN                        = 0x8102;
    const UNIQUE_ID                    = 0x8103;

    // Non Storable Secure Information 0x80;
    const PIN                          = 0x8181;
    const CVC                          = 0x8182;

    const IDENTIFICATION_TYPE_CI       = 0;
    const IDENTIFICATION_TYPE_PASSPORT = 1;
    const IDENTIFICATION_TYPE_OTHER    = 3;
    const IDENTIFICATION_TYPE_RUT      = 4;
}
