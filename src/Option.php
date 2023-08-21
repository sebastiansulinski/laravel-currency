<?php

namespace SSD\Currency;

use SSD\Currency\Currencies\Currency;

readonly class Option
{
    public string $label;

    public string $value;

    public function __construct(Currency $currency)
    {
        $this->value = $currency->code();
        $this->label = $currency->label();
    }
}
