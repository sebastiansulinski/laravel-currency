<?php

class CurrencyTestCase extends \TestCase
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