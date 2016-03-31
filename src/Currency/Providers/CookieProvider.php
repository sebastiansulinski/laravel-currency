<?php namespace SSD\Currency\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CookieProvider extends BaseProvider implements ProviderContract
{
    /**
     * Get current currency.
     *
     * @return string
     */
    public function get()
    {
        return strtolower($this->request->cookie(
            $this->config->get('key'),
            $this->config->get('default')
        ));
    }

    /**
     * Set currency.
     *
     * @param $currency
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function set($currency)
    {
        return cookie()->forever(
            $this->config->get('key'),
            strtolower($currency)
        );
    }

    /**
     * Check if currency matches argument.
     *
     * @param $currency
     * @return bool
     */
    public function is($currency)
    {
        return $this->get() == strtolower($currency);
    }
}