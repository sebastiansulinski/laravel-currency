<?php

namespace SSD\Currency;

use InvalidArgumentException;

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
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->attributes = $config;
    }

    /**
     * Get value associated with a given key.
     *
     * @param  string $name
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $name)
    {
        if (!array_key_exists($name, $this->attributes)) {
            throw new InvalidArgumentException("Key {$name} does not exist");
        }

        return $this->attributes[$name];
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
