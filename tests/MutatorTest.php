<?php namespace SSDTest;

use Illuminate\Http\Request;
use Mockery as m;

use SSD\Currency\Config;
use SSD\Currency\Currency;
use SSD\Currency\Providers\CookieProvider;

class MutatorTest extends TestCase
{
    public function tearDown() {
        m::close();
    }

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
}