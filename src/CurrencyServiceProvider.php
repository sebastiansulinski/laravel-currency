<?php

namespace SSD\Currency;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->singleton('currency', fn(Application $app) => new CurrencyService(
            $app->make(CurrencyStoreManager::class)->driver(),
            $app->make('config')->get('currency')
        ));
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/currency.php' => config_path('currency.php'),
        ]);
    }
}
