<?php

namespace SSD\Currency;

use Illuminate\Support\Collection;

/**
 * Class Config
 *
 * @package SSD\Currency
 *
 * @property string $key
 * @property string $default
 * @property array $currencies
 * @property bool $value_as_integer
 */
class Config
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Config constructor.
     *
     * @param  array $config
     */
    public function __construct(array $config)
    {
        $this->attributes = $config;
    }

    /**
     * Get currency class.
     *
     * @param  string $code
     * @return string
     */
    public function getClass(string $code): string
    {
        $classes = new Collection($this->attributes['currencies']);

        return $classes->filter(function (string $currency) use ($code) {
                return $currency::code() === $code;
            })->first() ?? $classes->filter(function (string $currency) {
                return $currency::code() === $this->attributes['default'];
            })->first();
    }

    /**
     * Get value associated with a given key.
     *
     * @param  string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Magically obtain config value.
     *
     * @param  string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->get($name);
    }
}
