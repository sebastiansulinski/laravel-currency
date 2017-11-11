<?php

namespace SSD\Currency\Providers;

use SSD\Currency\Config;

abstract class BaseProvider
{
    /**
     * @var \SSD\Currency\Config
     */
    public $config;

    /**
     * Cookie constructor.
     *
     * @param  \SSD\Currency\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Format value.
     *
     * @param  string $name
     * @return string
     */
    protected function value(string $name): string
    {
        return strtolower($name);
    }

    /**
     * Get currency.
     *
     * @return string
     */
    abstract public function get(): string;

    /**
     * Set currency.
     *
     * @param  string $currency
     * @return void
     */
    abstract public function set(string $currency): void;

    /**
     * Check if currency matches argument.
     *
     * @param  string $currency
     * @return bool
     */
    abstract public function is(string $currency): bool;
}