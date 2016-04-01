<?php namespace SSD\Currency\Providers;

interface ProviderContract
{
    /**
     * Get currency.
     *
     * @return string
     */
    public function get();

    /**
     * Set currency.
     *
     * @param $currency
     * @return void
     */
    public function set($currency);

    /**
     * Check if currency matches argument.
     *
     * @param $currency
     * @return bool
     */
    public function is($currency);
}