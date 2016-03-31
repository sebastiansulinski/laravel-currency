<?php namespace SSD\Currency\Providers;

use Illuminate\Http\Request;
use SSD\Currency\Config;

abstract class BaseProvider
{
    /**
     * @var Config
     */
    public $config;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Cookie constructor.
     * @param Config $config
     * @param Request $request
     */
    public function __construct(Config $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;
    }
}