<?php

namespace SSD\Currency\Providers;

use SSD\Currency\Config;

abstract class BaseProvider
{
    /**
     * @var Config
     */
    public $config;

    /**
     * Cookie constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Format value.
     *
     * @param $name
     * @return mixed
     */
    protected function value($name)
    {
        return strtolower($name);
    }

    /**
     * Get currency.
     *
     * @return string
     */
    abstract public function get();

    /**
     * Set currency.
     *
     * @param $currency
     * @return void
     */
    abstract public function set($currency);

    /**
     * Check if currency matches argument.
     *
     * @param $currency
     * @return bool
     */
    abstract public function is($currency);
}