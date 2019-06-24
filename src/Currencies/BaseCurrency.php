<?php

namespace SSD\Currency\Currencies;

abstract class BaseCurrency
{
    /**
     * Get symbol.
     *
     * @return string
     */
    abstract public static function symbol(): string;

    /**
     * Get code.
     *
     * @return string
     */
    abstract public static function code(): string;

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
     * Display value as decimal with currency symbol.
     *
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function withSymbol(float $value, int $decimal_points = null): string
    {
        return $this->symbol().$this->value($value, $decimal_points);
    }

    /**
     * Display value as decimal with currency code.
     *
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function withCode(float $value, int $decimal_points = null): string
    {
        return $this->value($value, $decimal_points).' '.$this->code();
    }

    /**
     * Display value as decimal
     * with currency symbol and code.
     *
     * @param  float $value
     * @param  int|null $decimal_points
     * @return string
     */
    public function withSymbolAndCode(float $value, int $decimal_points = null): string
    {
        return $this->symbol().$this->value($value, $decimal_points).' '.$this->code();
    }

    /**
     * Get label to be displayed with the select option.
     *
     * @return string
     */
    public function label(): string
    {
        return $this->code().' ('.$this->symbol().')';
    }
}
