<?php

namespace SSDTest\Fixtures;

use SSD\Currency\Currencies\Currency;

class PLN extends Currency
{
    /**
     * Get symbol.
     */
    public static function symbol(): string
    {
        return 'zł';
    }

    /**
     * Get code.
     */
    public static function code(): string
    {
        return 'PLN';
    }

    /**
     * Determine if symbol should be placed after the value.
     */
    protected static function symbolAfterValue(): bool
    {
        return true;
    }

    /**
     * Determine if there is a space between symbol and the value.
     */
    protected static function symbolSpace(): bool
    {
        return true;
    }
}
