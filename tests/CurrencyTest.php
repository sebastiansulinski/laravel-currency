<?php namespace Test;

use PHPUnit_Framework_Error;

use SSD\Currency\Config;
use SSD\Currency\Currency;
use SSD\Currency\Providers\CookieProvider;

class CurrencyTest extends BaseCase
{
    /**
     * @var Currency
     */
    protected $currency;

    /**
     * Instantiate Currency.
     */
    public function setCurrency()
    {
        $this->currency = new Currency(new CookieProvider(
            new Config($this->config)
        ));
    }

    /**
     * @test
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function throws_error_if_instantiated_without_argument()
    {
        $currency = new Currency();
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix()
    {
        $this->setCurrency();

        $result = $this->currency->withPrefix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'gbp');

        $this->assertEquals('£20.00', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_postfix()
    {
        $this->setCurrency();

        $result = $this->currency->withPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'eur');

        $this->assertEquals('23.00 EUR', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_and_postfix()
    {
        $this->setCurrency();

        $result = $this->currency->withPrefixAndPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'usd');

        $this->assertEquals('$35.00 USD', $result);
    }
}