<?php

namespace SSD\Currency;

use Illuminate\Support\Facades\Facade;

/**
 * Class CurrencyFacade
 *
 * @package SSD\Currency
 *
 * @method static string decimal($values, string $currency = null, int $decimal_points = 2)
 * @method static int integer($values, string $currency = null)
 * @method static string withPrefix($values, string $currency = null, int $decimal_points = null)
 * @method static string withPostfix($values, string $currency = null, int $decimal_points = null)
 * @method static string withPrefixAndPostfix($values, string $currency = null, int $decimal_points = null)
 * @method static array options()
 * @method static bool selected(string $currency)
 * @method static string get()
 * @method static void set(string $currency)
 * @method static bool is(string $currency)
 *
 * @see \SSD\Currency\Currency
 */
class CurrencyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'currency';
    }
}
