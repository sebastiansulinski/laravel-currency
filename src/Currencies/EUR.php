<?php

namespace SSD\Currency\Currencies;

class EUR extends Currency
{
    /**
     * Get symbol.
     */
    public static function symbol(): string
    {
        return '€';
    }

    /**
     * Get code.
     */
    public static function code(): string
    {
        return 'EUR';
    }
}
