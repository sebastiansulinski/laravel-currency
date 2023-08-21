<?php

use SSD\Currency\Currencies\EUR;
use SSD\Currency\Currencies\GBP;
use SSD\Currency\Currencies\USD;

return [

    /*
    |--------------------------------------------------------------------------
    | Session store.
    |--------------------------------------------------------------------------
    |
    | This value represents the store used to persist selected currency.
    | Currently available options: 'cookie', 'session'.
    */

    'store' => 'cookie',

    /*
    |--------------------------------------------------------------------------
    | Session key.
    |--------------------------------------------------------------------------
    |
    | This value is the name of the index representing the selected currency.
    */

    'key' => 'currency',

    /*
    |--------------------------------------------------------------------------
    | Default currency.
    |--------------------------------------------------------------------------
    |
    | This value represents default currency.
    */

    'default' => GBP::code(),

    /*
    |--------------------------------------------------------------------------
    | Currencies.
    |--------------------------------------------------------------------------
    |
    | This value represents the list of available currencies.
    */

    'currencies' => [
        GBP::class,
        USD::class,
        EUR::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Value as integer.
    |--------------------------------------------------------------------------
    |
    | This value indicates whether the provided values
    | are stored as integer or float / decimal.
    */

    'value_as_integer' => false,
];
