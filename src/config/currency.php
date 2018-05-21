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

    "default" => "gbp",

    /*
    |--------------------------------------------------------------------------
    | Currencies.
    |--------------------------------------------------------------------------
    |
    | This value represents the list of available currencies.
    */

    "currencies" => [
        "gbp" => \SSD\Currency\Currencies\GBP::class,
        "usd" => \SSD\Currency\Currencies\USD::class,
        "eur" => \SSD\Currency\Currencies\EUR::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Value as integer.
    |--------------------------------------------------------------------------
    |
    | This value indicates whether the provided values
    | are stored as integer or float / decimal.
    */

    "value_as_integer" => false
];