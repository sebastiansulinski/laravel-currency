<?php namespace SSD\Currency\Currencies;

class GBP extends BaseCurrency implements CurrencyContract
{
    /**
     * @var string
     */
    protected $prefix = '£';

    /**
     * @var string
     */
    protected $postfix = 'GBP';
}