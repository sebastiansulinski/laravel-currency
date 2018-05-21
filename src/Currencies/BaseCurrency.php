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
     * @param  float $value
     * @param  int $decimal_points
     * @return string
     */
    public function decimal(float $value, int $decimal_points = 2): string
    {
        return number_format($value, $decimal_points);
    }

    /**
     * Convert value to integer.
     *
     * @param  float $value
     * @return int
     */
    public function integer(float $value): int
    {
        return (int)$value;
    }

    /**
     * Get formatted value.
     *
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function value(float $value, int $decimal_points = null): string
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
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function prefix(float $value, int $decimal_points = null): string
    {
        return $this->prefix.$this->value($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency label.
     *
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function postfix(float $value, int $decimal_points = null): string
    {
        return $this->value($value, $decimal_points).' '.$this->postfix;
    }

    /**
     * Display value as decimal
     * with currency symbol and label.
     *
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function prefixPostfix(float $value, int $decimal_points = null): string
    {
        return $this->prefix.$this->value($value, $decimal_points).' '.$this->postfix;
    }

    /**
     * Get label to be displayed with the select option.
     *
     * @return string
     */
    public function label(): string
    {
        return $this->postfix.' ('.$this->prefix.')';
    }
}
