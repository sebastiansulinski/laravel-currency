<?php

namespace SSDTest\Fixtures;

use SSD\Currency\Currencies\BaseCurrency;

class PLN extends BaseCurrency
{
    /**
     * Get symbol.
     *
     * @return string
     */
    public static function symbol(): string
    {
        return 'zł';
    }

    /**
     * Get code.
     *
     * @return string
     */
    public static function code(): string
    {
        return 'PLN';
    }

    /**
     * Determine if symbol should be placed after the value.
     *
     * @return bool
     */
    protected static function symbolAfterValue(): bool
    {
        return true;
    }

    /**
     * Determine if there is a space between symbol and the value.
     *
     * @return bool
     */
    protected static function symbolSpace(): bool
    {
        return true;
    }
}