<?php

namespace SSDTest;

use PHPUnit\Framework\TestCase;

class CurrencyBaseCase extends TestCase
{
    /**
     * @var array
     */
    protected $config = null;

    /**
     * Set up.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        if (is_null($this->config)) {
            $this->config = require("config/currency.php");
        }
    }
}