<?php namespace SSD\Currency\Currencies;

class EUR extends BaseCurrency implements CurrencyContract
{
    /**
     * @var string
     */
    protected $prefix = '€';

    /**
     * @var string
     */
    protected $postfix = 'EUR';
}