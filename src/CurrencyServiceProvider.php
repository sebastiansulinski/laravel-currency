<?php

namespace SSD\Currency;

use Illuminate\Support\ServiceProvider;
use SSD\Currency\Providers\CookieProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/currency.php' => config_path('currency.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('currency', function ($app) {

            return new Currency(new CookieProvider(
                new Config($app->make('config')->get('currency')),
                $app->make('request')
            ));

        });
    }
}
