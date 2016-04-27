<?php namespace SSD\Currency\Currencies;

class BRL extends BaseCurrency implements CurrencyContract
{
    /**
     * @var string
     */
    protected $prefix = 'R$';

    /**
     * @var string
     */
    protected $postfix = 'BRL';
}
