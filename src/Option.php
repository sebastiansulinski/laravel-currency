<?php namespace SSD\Currency;

use InvalidArgumentException;
use SSD\Currency\Currencies\CurrencyContract;

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
     * @param $value
     * @param $currency
     */
    public function __construct($value, CurrencyContract $currency)
    {
        $this->value = $value;
        $this->label = $currency->label();
    }

    /**
     * Get object property.
     *
     * @param $name
     */
    public function __get($name)
    {
        if ( ! in_array($name, ['value', 'label'])) {
            throw new InvalidArgumentException("Property {$name} does not exist");
        }

        return $this->{$name};
    }


}