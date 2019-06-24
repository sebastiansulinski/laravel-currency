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
            'GBP' => 20.53,
            'EUR' => 23.00,
            'USD' => 35.18
        ], 'GBP');

        $this->assertEquals(20.53, $result);


        $result = $this->currency(true)->decimal([
            'GBP' => 2053,
            'EUR' => 2300,
            'USD' => 3518
        ], 'GBP');

        $this->assertEquals(20.53, $result);
    }

    /**
     * @test
     */
    public function pulls_value_as_integer()
    {
        $result = $this->currency()->integer([
            'GBP' => 20.53,
            'EUR' => 23.00,
            'USD' => 35.18
        ], 'GBP');

        $this->assertEquals(20, $result);


        $result = $this->currency(true)->integer([
            'GBP' => 2053,
            'EUR' => 2300,
            'USD' => 3518
        ], 'GBP');

        $this->assertEquals(2053, $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_symbol_without_decimals()
    {
        $result = $this->currency()->withSymbol([
            'GBP' => 20,
            'EUR' => 23,
            'USD' => 35
        ], 'GBP');

        $this->assertEquals('£20', $result);


        $result = $this->currency(true)->withSymbol([
            'GBP' => 2000,
            'EUR' => 2300,
            'USD' => 3500
        ], 'GBP');

        $this->assertEquals('£20', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_symbol_with_two_decimals()
    {
        $result = $this->currency()->withSymbol([
            'GBP' => 20.53,
            'EUR' => 23.00,
            'USD' => 35.18
        ], 'GBP', 2);

        $this->assertEquals('£20.53', $result);


        $result = $this->currency(true)->withSymbol([
            'GBP' => 2053,
            'EUR' => 2300,
            'USD' => 3518
        ], 'GBP', 2);

        $this->assertEquals('£20.53', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_code_without_decimals()
    {
        $result = $this->currency()->withCode([
            'GBP' => 20,
            'EUR' => 23,
            'USD' => 35
        ], 'EUR');

        $this->assertEquals('23 EUR', $result);


        $result = $this->currency(true)->withCode([
            'GBP' => 2000,
            'EUR' => 2300,
            'USD' => 3500
        ], 'GBP');

        $this->assertEquals('20 GBP', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_code_with_two_decimals()
    {
        $result = $this->currency()->withCode([
            'GBP' => 20,
            'EUR' => 23,
            'USD' => 35
        ], 'EUR', 2);

        $this->assertEquals('23.00 EUR', $result);


        $result = $this->currency(true)->withCode([
            'GBP' => 2053,
            'EUR' => 2300,
            'USD' => 3518
        ], 'GBP', 2);

        $this->assertEquals('20.53 GBP', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_symbol_and_code_without_decimals()
    {
        $result = $this->currency()->withSymbolAndCode([
            'GBP' => 20,
            'EUR' => 23,
            'USD' => 35
        ], 'USD');

        $this->assertEquals('$35 USD', $result);


        $result = $this->currency(true)->withSymbolAndCode([
            'GBP' => 2000,
            'EUR' => 2300,
            'USD' => 3500
        ], 'USD');

        $this->assertEquals('$35 USD', $result);
    }

    /**
     * @test
     */
    public function pulls_value_with_symbol_and_code_with_two_decimals()
    {
        $result = $this->currency()->withSymbolAndCode([
            'GBP' => 20,
            'EUR' => 23,
            'USD' => 35
        ], 'USD', 2);

        $this->assertEquals('$35.00 USD', $result);


        $result = $this->currency(true)->withSymbolAndCode([
            'GBP' => 2053,
            'EUR' => 2300,
            'USD' => 3518
        ], 'USD', 2);

        $this->assertEquals('$35.18 USD', $result);
    }
}