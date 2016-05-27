<?php

class CurrencyTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Set up.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->config = require("config/currency.php");
    }
}