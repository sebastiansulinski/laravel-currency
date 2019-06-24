<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Session key.
    |--------------------------------------------------------------------------
    |
    | This value is the name of the index representing the selected currency.
    */

    "key" => "currency",

    /*
    |--------------------------------------------------------------------------
    | Default currency.
    |--------------------------------------------------------------------------
    |
    | This value represents default currency.
    */

    "default" => \SSD\Currency\Currencies\GBP::code(),

    /*
    |--------------------------------------------------------------------------
    | Currencies.
    |--------------------------------------------------------------------------
    |
    | This value represents the list of available currencies.
    */

    "currencies" => [
        \SSD\Currency\Currencies\GBP::class,
        \SSD\Currency\Currencies\USD::class,
        \SSD\Currency\Currencies\EUR::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Value as integer.
    |--------------------------------------------------------------------------
    |
    | This value indicates whether the provided values
    | are stored as integer or float / decimal.
    */

    "value_as_integer" => false,
];