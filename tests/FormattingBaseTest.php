<?php

namespace SSDTest;

use Illuminate\Http\Request;

use SSD\Currency\Config;
use SSD\Currency\Currency;
use SSD\Currency\Providers\CookieProvider;

class FormattingBaseTest extends CurrencyBaseCase
{
    /**
     * Instantiate Currency.
     *
     * @param  bool $asInteger
     * @return \SSD\Currency\Currency
     */
    public function currency(bool $asInteger = false): Currency
    {
        return new Currency(new CookieProvider(
            new Config(array_merge($this->config, [
                'value_as_integer' => $asInteger
            ])),
            Request::capture()
        ));
    }

    /**
     * @test
     */
    public function pulls_value_as_decimal()
    {
        $result = $this->currency()->decimal([
            'gbp' => 20.53,
            'eur' => 23.00,
            'usd' => 35.18
        ], 'gbp');

        $this->assertEquals(20.53, $result);


        $result = $this->currency(true)->decimal([
            'gbp' => 2053,
            'eur' => 2300,
            'usd' => 3518
        ], 'gbp');

        $this->assertEquals(20.53, $result);
    }

    /**
     * @test
     */
    public function pulls_value_as_integer()
    {
        $result = $this->currency()->integer([
            'gbp' => 20.53,
            'eur' => 23.00,
            'usd' => 35.18
        ], 'gbp');

        $this->assertEquals(20, $result);


        $result = $this->currency(true)->integer([
            'gbp' => 2053,
            'eur' => 2300,
            'usd' => 3518
        ], 'gbp');

        $this->assertEquals(2053, $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_without_decimals()
    {
        $result = $this->currency()->withPrefix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'gbp');

        $this->assertEquals('£20', $result);


        $result = $this->currency(true)->withPrefix([
            'gbp' => 2000,
            'eur' => 2300,
            'usd' => 3500
        ], 'gbp');

        $this->assertEquals('£20', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_with_two_decimals()
    {
        $result = $this->currency()->withPrefix([
            'gbp' => 20.53,
            'eur' => 23.00,
            'usd' => 35.18
        ], 'gbp', 2);

        $this->assertEquals('£20.53', $result);


        $result = $this->currency(true)->withPrefix([
            'gbp' => 2053,
            'eur' => 2300,
            'usd' => 3518
        ], 'gbp', 2);

        $this->assertEquals('£20.53', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_postfix_without_decimals()
    {
        $result = $this->currency()->withPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'eur');

        $this->assertEquals('23 EUR', $result);


        $result = $this->currency(true)->withPostfix([
            'gbp' => 2000,
            'eur' => 2300,
            'usd' => 3500
        ], 'gbp');

        $this->assertEquals('20 GBP', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_postfix_with_two_decimals()
    {
        $result = $this->currency()->withPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'eur', 2);

        $this->assertEquals('23.00 EUR', $result);


        $result = $this->currency(true)->withPostfix([
            'gbp' => 2053,
            'eur' => 2300,
            'usd' => 3518
        ], 'gbp', 2);

        $this->assertEquals('20.53 GBP', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_and_postfix_without_decimals()
    {
        $result = $this->currency()->withPrefixAndPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'usd');

        $this->assertEquals('$35 USD', $result);


        $result = $this->currency(true)->withPrefixAndPostfix([
            'gbp' => 2000,
            'eur' => 2300,
            'usd' => 3500
        ], 'usd');

        $this->assertEquals('$35 USD', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_prefix_and_postfix_with_two_decimals()
    {
        $result = $this->currency()->withPrefixAndPostfix([
            'gbp' => 20,
            'eur' => 23,
            'usd' => 35
        ], 'usd', 2);

        $this->assertEquals('$35.00 USD', $result);


        $result = $this->currency(true)->withPrefixAndPostfix([
            'gbp' => 2053,
            'eur' => 2300,
            'usd' => 3518
        ], 'usd', 2);

        $this->assertEquals('$35.18 USD', $result);
    }
}