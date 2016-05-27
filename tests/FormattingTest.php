<?php

use Illuminate\Http\Request;

use SSD\Currency\Config;
use SSD\Currency\Currency;
use SSD\Currency\Providers\CookieProvider;

class FormattingTest extends CurrencyTestCase
{
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

    /**
     * @test
     */
    public function pulls_value_with_prefix_without_decimals()
    {
        $result = $this->currency->withPrefix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'gbp');

        $this->assertEquals('£20', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_with_two_decimals()
    {
        $result = $this->currency->withPrefix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'gbp', 2);

        $this->assertEquals('£20.00', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_postfix_without_decimals()
    {
        $result = $this->currency->withPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'eur');

        $this->assertEquals('23 EUR', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_postfix_with_two_decimals()
    {
        $result = $this->currency->withPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'eur', 2);

        $this->assertEquals('23.00 EUR', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_and_postfix_without_decimals()
    {
        $result = $this->currency->withPrefixAndPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'usd');

        $this->assertEquals('$35 USD', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_and_postfix_with_two_decimals()
    {
        $result = $this->currency->withPrefixAndPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'usd', 2);

        $this->assertEquals('$35.00 USD', $result);
    }
}