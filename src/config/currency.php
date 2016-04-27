<?php

return [
    "key" => "currency",
    "default" => "gbp",
    "currencies" => [
        "gbp" => \SSD\Currency\Currencies\GBP::class,
        "usd" => \SSD\Currency\Currencies\USD::class,
        "eur" => \SSD\Currency\Currencies\EUR::class,
        "brl" => \SSD\Currency\Currencies\BRL::class
    ]
];
