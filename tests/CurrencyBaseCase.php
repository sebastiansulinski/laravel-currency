<?php

namespace SSDTest;

use PHPUnit\Framework\TestCase;

class CurrencyBaseCase extends TestCase
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
    public function setUp(): void
    {
        parent::setUp();

        if (is_null($this->config)) {
            $this->config = require("config/currency.php");
        }
    }
}