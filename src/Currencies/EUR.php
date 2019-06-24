<?php

namespace SSD\Currency\Currencies;

class EUR extends BaseCurrency
{
    /**
     * Get symbol.
     *
     * @return string
     */
    public static function symbol(): string
    {
        return '€';
    }

    /**
     * Get code.
     *
     * @return string
     */
    public static function code(): string
    {
        return 'EUR';
    }
}