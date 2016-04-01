<?php namespace SSDTest;

use Illuminate\Http\Request;

use SSD\Currency\Config;
use SSD\Currency\Currency;
use SSD\Currency\Providers\CookieProvider;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var Currency
     */
    protected $currency;

    /**
     * Set up.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->config = require("config/currency.php");

        $this->setCurrency();
    }

    /**
     * Instantiate Currency.
     *
     * @return void
     */
    public function setCurrency()
    {
        $this->currency = new Currency(new CookieProvider(
            new Config($this->config),
            Request::capture()
        ));
    }
}