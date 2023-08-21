<?php

namespace SSD\Currency\Currencies;

class USD extends Currency
{
    /**
     * Get symbol.
     */
    public static function symbol(): string
    {
        return '$';
    }

    /**
     * Get code.
     */
    public static function code(): string
    {
        return 'USD';
    }
}
