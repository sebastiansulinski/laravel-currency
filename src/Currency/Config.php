<?php namespace SSD\Currency;

use InvalidArgumentException;

class Config
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new InvalidArgumentException("Invalid configuration");
        }

        foreach($config as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * Get value associated with a given key.
     *
     * @param $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get($key)
    {
        if ( ! array_key_exists($key, $this->attributes)) {
            throw new InvalidArgumentException("Key {$key} does not exist");
        }

        return $this->attributes[$key];
    }
}