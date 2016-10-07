<?php

namespace SSD\Currency\Currencies;

abstract class BaseCurrency
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $postfix;

    /**
     * Convert value to decimal.
     *
     * @param float $value
     * @param int $decimal_points
     * @return string
     */
    public function decimal($value, $decimal_points = 2)
    {
        return number_format($value, $decimal_points);
    }

    /**
     * Get formatted value.
     *
     * @param float $value
     * @param null|int $decimal_points
     * @return string
     */
    public function value($value, $decimal_points = null)
    {
        if (is_null($decimal_points)) {
            return $value;
        }

        return $this->decimal($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency symbol.
     *
     * @param float $value
     * @param null|int $decimal_points
     * @return mixed
     */
    public function prefix($value, $decimal_points = null)
    {
        return $this->prefix . $this->value($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency label.
     *
     * @param float $value
     * @param null|int $decimal_points
     * @return mixed
     */
    public function postfix($value, $decimal_points = null)
    {
        return $this->value($value, $decimal_points) . ' ' . $this->postfix;
    }

    /**
     * Display value as decimal
     * with currency symbol and label.
     *
     * @param float $value
     * @param null|int $decimal_points
     * @return mixed
     */
    public function prefix_postfix($value, $decimal_points = null)
    {
        return $this->prefix . $this->value($value, $decimal_points) . ' ' . $this->postfix;
    }

    /**
     * Get label to be displayed with the select option.
     *
     * @return string
     */
    public function label()
    {
        return $this->postfix . ' (' . $this->prefix . ')';
    }
}