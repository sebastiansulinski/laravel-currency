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
     * Format code.
     *
     * @param  string $code
     * @return string
     */
    protected function value(string $code): string
    {
        return strtoupper($code);
    }

    /**
     * Get current currency code.
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