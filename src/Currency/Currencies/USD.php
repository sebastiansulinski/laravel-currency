<?php namespace SSD\Currency\Currencies;

class USD extends BaseCurrency implements CurrencyContract
{
    /**
     * @var string
     */
    protected $prefix = '$';

    /**
     * @var string
     */
    protected $postfix = 'USD';
}