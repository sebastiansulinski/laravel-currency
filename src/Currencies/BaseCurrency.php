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
     * @param  int $decimals
     * @param  string $dec_point
     * @param  string $thousands_sep
     * @return string
     */
    public function decimal(float $value, int $decimals = 2, string $dec_point = '.', string $thousands_sep = ','): string
    {
        return number_format($value, $decimals, $dec_point, $thousands_sep);
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
     * @param  int|null $decimals
     * @param  string|null $dec_point
     * @param  string|null $thousands_sep
     * @return string
     */
    public function value(float $value, int $decimals = null, string $dec_point = null, string $thousands_sep = null): string
    {
        if (is_null($decimals)) {
            return $value;
        }

        return $this->decimal($value, $decimals, $dec_point, $thousands_sep);
    }

    /**
     * Display value as decimal
     * with currency symbol.
     *
     * @param  float $value
     * @param  int|null $decimals
     * @param  string|null $dec_point
     * @param  string|null $thousands_sep
     * @return string
     */
    public function prefix(float $value, int $decimals = null, string $dec_point = null, string $thousands_sep = null): string
    {
        return $this->prefix.$this->value($value, $decimals, $dec_point, $thousands_sep);
    }

    /**
     * Display value as decimal
     * with currency label.
     *
     * @param  float $value
     * @param  int|null $decimals
     * @param  string|null $dec_point
     * @param  string|null $thousands_sep
     * @return string
     */
    public function postfix(float $value, int $decimals = null, string $dec_point = null, string $thousands_sep = null): string
    {
        return $this->value($value, $decimals, $dec_point, $thousands_sep).' '.$this->postfix;
    }

    /**
     * Display value as decimal
     * with currency symbol and label.
     *
     * @param  float $value
     * @param  int|null $decimals
     * @param  string|null $dec_point
     * @param  string|null $thousands_sep
     * @return string
     */
    public function prefixPostfix(float $value, int $decimals = null, string $dec_point = null, string $thousands_sep = null): string
    {
        return $this->prefix.$this->value($value, $decimals, $dec_point, $thousands_sep).' '.$this->postfix;
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
