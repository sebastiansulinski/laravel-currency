<?php

namespace SSD\Currency;

use Illuminate\Support\Collection;

class Config
{
    public string $key;
    public string $default;
    public Collection $currencies;
    public bool $value_as_integer;

    public function __construct(array $config)
    {
        $this->key = $config['key'];
        $this->default = $config['default'];
        $this->currencies = new Collection($config['currencies']);
        $this->value_as_integer = $config['value_as_integer'];
    }
}
