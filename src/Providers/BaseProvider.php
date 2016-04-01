<?php namespace SSD\Currency\Providers;

use SSD\Currency\Config;

abstract class BaseProvider
{
    /**
     * @var Config
     */
    public $config;

    /**
     * Cookie constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Format value.
     *
     * @param $name
     * @return mixed
     */
    protected function value($name)
    {
        return strtolower($name);
    }
}