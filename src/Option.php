<?php

namespace SSD\Currency;

use InvalidArgumentException;
use SSD\Currency\Currencies\BaseCurrency;

class Option
{
    /**
     * Option value.
     *
     * @var string
     */
    private $value;

    /**
     * Option label.
     *
     * @var string
     */
    private $label;

    /**
     * Option constructor.
     *
     * @param  string $value
     * @param  \SSD\Currency\Currencies\BaseCurrency $currency
     */
    public function __construct(string $value, BaseCurrency $currency)
    {
        $this->value = $value;
        $this->label = $currency->label();
    }

    /**
     * Get object property.
     *
     * @param  string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (!in_array($name, ['value', 'label'])) {
            throw new InvalidArgumentException("Property {$name} does not exist");
        }

        return $this->{$name};
    }
}
