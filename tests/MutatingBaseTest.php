<?php

namespace SSDTest;

use Mockery as m;
use Illuminate\Http\Request;

use SSD\Currency\Config;
use SSD\Currency\Currency;
use SSD\Currency\Providers\CookieProvider;

class MutatingBaseTest extends CurrencyBaseCase
{
    /**
     * @test
     */
    public function gets_default_currency_without_currency_being_previously_set()
    {
        $config = new Config($this->config);

        $currency = new Currency(new CookieProvider(
            $config,
            Request::capture()
        ));

        $this->assertEquals($config->get('default'), $currency->get());
    }

    /**
     * @test
     */
    public function sets_the_right_currency()
    {
        $config = new Config($this->config);

        $provider = m::mock(
            'SSD\Currency\Providers\CookieProvider',
            [
                $config,
                Request::capture()
            ]
        );

        $provider->shouldReceive('set')
                 ->with('eur')
                 ->andReturn('eur');

        $provider->shouldReceive('get')
                 ->andReturn('eur');

        $currency = new Currency($provider);

        $currency->set('eur');

        $this->assertEquals('eur', $currency->get());
    }

    /**
     * @test
     */
    public function checks_if_the_currently_selected_currency_is_the_default_one()
    {
        $config = new Config($this->config);

        $currency = new Currency(new CookieProvider(
            $config,
            Request::capture()
        ));

        $this->assertTrue($currency->is($config->get('default')));
    }

    /**
     * @test
     */
    public function sets_currency_and_checks_if_it_matches()
    {
        $config = new Config($this->config);

        $provider = m::mock(
            'SSD\Currency\Providers\CookieProvider',
            [
                $config,
                Request::capture()
            ]
        );

        $provider->shouldReceive('set')
                 ->with('usd');

        $provider->shouldReceive('is')
                 ->andReturn(true);

        $currency = new Currency($provider);

        $currency->set('usd');

        $this->assertTrue($currency->is('usd'));
    }
}