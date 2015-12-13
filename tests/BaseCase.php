<?php namespace Test;

use PHPUnit_Framework_TestCase;

abstract class BaseCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Set up.
     */
    public function setUp()
    {
        $this->config = require("config/currency.php");
    }
}