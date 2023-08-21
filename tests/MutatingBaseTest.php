<?php

namespace SSDTest;

use Illuminate\Http\Request;
use Mockery as m;
use SSD\Currency\Config;
use SSD\Currency\CurrencyService;
use SSD\Currency\Stores\CookieStore;

class MutatingBaseTest extends CurrencyBaseCase
{
    /**
     * @test
     */
    public function gets_default_currency_without_currency_being_previously_set()
    {
        $config = new Config($this->config);

        $currency = new CurrencyService(new CookieStore(
            $config,
            Request::capture()
        ));

        $this->assertEquals($config->default, $currency->get());
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
                Request::capture(),
            ]
        );

        $provider->shouldReceive('set')
            ->with('EUR')
            ->andReturn('EUR');

        $provider->shouldReceive('get')
            ->andReturn('EUR');

        $currency = new CurrencyService($provider);

        $currency->set('EUR');

        $this->assertEquals('EUR', $currency->get());
    }

    /**
     * @test
     */
    public function checks_if_the_currently_selected_currency_is_the_default_one()
    {
        $config = new Config($this->config);

        $currency = new CurrencyService(new CookieStore(
            $config,
            Request::capture()
        ));

        $this->assertTrue($currency->is($config->default));
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
                Request::capture(),
            ]
        );

        $provider->shouldReceive('set')
            ->with('USD');

        $provider->shouldReceive('is')
            ->andReturn(true);

        $currency = new CurrencyService($provider);

        $currency->set('USD');

        $this->assertTrue($currency->is('USD'));
    }
}
