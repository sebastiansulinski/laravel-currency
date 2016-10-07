<?php

namespace SSD\Currency\Providers;

use SSD\Currency\Config;

use Illuminate\Http\Request;

class CookieProvider extends BaseProvider
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * CookieProvider constructor.
     *
     * @param Config $config
     * @param Request $request
     */
    public function __construct(Config $config, Request $request)
    {
        parent::__construct($config);

        $this->request = $request;
    }

    /**
     * Get current currency.
     *
     * @return string
     */
    public function get()
    {
        return $this->value($this->request->cookie(
            $this->config->get('key'),
            $this->config->get('default')
        ));
    }

    /**
     * Set currency.
     *
     * @param $currency
     * @return void
     */
    public function set($currency)
    {
        cookie()->queue(
            $this->config->get('key'),
            $this->value($currency)
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
        return $this->get() == $this->value($currency);
    }
}