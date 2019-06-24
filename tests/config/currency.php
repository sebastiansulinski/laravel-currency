<?php

return [
    "key" => "currency",
    "default" => \SSD\Currency\Currencies\GBP::code(),
    "currencies" => [
        \SSD\Currency\Currencies\GBP::class,
        \SSD\Currency\Currencies\USD::class,
        \SSD\Currency\Currencies\EUR::class
    ],
    "value_as_integer" => false
];