<?php namespace SSD\Currency\Currencies;

interface CurrencyContract
{
    /**
     * Display value as decimal
     * without currency symbol or label.
     *
     * @param $value
     * @return mixed
     */
    public function decimal($value);

    /**
     * Display value as decimal
     * with currency symbol.
     *
     * @param $value
     * @return mixed
     */
    public function prefix($value);

    /**
     * Display value as decimal
     * with currency label.
     *
     * @param $value
     * @return mixed
     */
    public function postfix($value);

    /**
     * Display value as decimal
     * with currency symbol and label.
     *
     * @param $value
     * @return mixed
     */
    public function prefix_postfix($value);

    /**
     * Get label to be displayed with the select option.
     *
     * @return string
     */
    public function label();
}