<?php

namespace SSD\Currency;

use Illuminate\Support\Manager;
use InvalidArgumentException;
use SSD\Currency\Stores\CookieStore;
use SSD\Currency\Stores\SessionStore;
use SSD\Currency\Stores\Store;

class CurrencyStoreManager extends Manager
{
    /**
     * {@inheritDoc}
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('currency.store');
    }

    /**
     * Create cookie driver.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createCookieDriver(): Store
    {
        return $this->createDriverFor('cookie');
    }

    /**
     * Create driver for a specific case.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function createDriverFor(string $case): Store
    {
        $config = $this->config->get('currency');

        return match ($case) {
            'session' => new SessionStore(
                $this->container->make('request'),
                $config['key'], $config['default']
            ),
            'cookie' => new CookieStore(
                $this->container->make('request'),
                $config['key'], $config['default']
            ),
            default => throw new InvalidArgumentException(
                'Invalid currency store selected'
            )
        };
    }

    /**
     * Create session driver.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createSessionDriver(): Store
    {
        return $this->createDriverFor('session');
    }
}
