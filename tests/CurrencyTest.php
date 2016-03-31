<?php namespace SSDTest;

class CurrencyTest extends TestCase
{
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

    // TODO
    // write set / get / is tests
    // with ArrayProvider / Test Double for Cookie Provider

//    /**
//     * @test
//     */
//    public function sets_new_currency()
//    {
//        $this->currency->set('eur');
//
//        $this->assertEquals('eur', $this->currency->get());
//    }
}