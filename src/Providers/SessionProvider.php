<?php

namespace SSD\Currency\Providers;

use SSD\Currency\Config;
use Illuminate\Http\Request;

class SessionProvider extends BaseProvider
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * SessionProvider constructor.
     *
     * @param  \SSD\Currency\Config $config
     * @param  \Illuminate\Http\Request $request
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
    public function get(): string
    {
        return $this->value($this->request->session()->get(
            $this->config->key,
            $this->config->default
        ));
    }

    /**
     * Set currency.
     *
     * @param  string $currency
     * @return void
     */
    public function set(string $currency): void
    {
        $this->request->session()->put(
            $this->config->key,
            $this->value($currency)
        );
    }

    /**
     * Check if currency matches argument.
     *
     * @param  string $currency
     * @return bool
     */
    public function is(string $currency): bool
    {
        return $this->get() == $this->value($currency);
    }
}
