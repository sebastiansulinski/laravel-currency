<?php namespace SSD\Currency\Providers;

use Illuminate\Http\Request;

use SSD\Currency\Config;

class SessionProvider extends BaseProvider implements ProviderContract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * SessionProvider constructor.
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
        return $this->value($this->request->session()->get(
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
        $this->request->session()->put(
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