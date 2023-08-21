<?php

namespace SSD\Currency\Currencies;

abstract class Currency
{
    /**
     * Convert value to integer.
     */
    public function integer(float $value): int
    {
        return (int) $value;
    }

    /**
     * Display value as decimal with currency symbol.
     */
    public function withSymbol(float $value, int $decimal_points = null): string
    {
        $value = $this->value($value, $decimal_points);

        $space = $this->symbolSpace() ? ' ' : '';

        $arguments = $this->symbolAfterValue() ?
            [$value, $space, $this->symbol()] : [$this->symbol(), $space, $value];

        return sprintf('%s%s%s', ...$arguments);
    }

    /**
     * Get formatted value.
     */
    public function value(float $value, int $decimal_points = null): string
    {
        if (is_null($decimal_points)) {
            return $value;
        }

        return $this->decimal($value, $decimal_points);
    }

    /**
     * Convert value to decimal.
     */
    public function decimal(float $value, int $decimal_points = 2): string
    {
        return number_format($value, $decimal_points);
    }

    /**
     * Determine if there is a space between symbol and the value.
     */
    protected static function symbolSpace(): bool
    {
        return false;
    }

    /**
     * Determine if symbol should be placed after the value.
     */
    protected static function symbolAfterValue(): bool
    {
        return false;
    }

    /**
     * Get symbol.
     */
    abstract public static function symbol(): string;

    /**
     * Display value as decimal with currency code.
     */
    public function withCode(float $value, int $decimal_points = null): string
    {
        return $this->value($value, $decimal_points).' '.$this->code();
    }

    /**
     * Get code.
     */
    abstract public static function code(): string;

    /**
     * Display value as decimal
     * with currency symbol and code.
     */
    public function withSymbolAndCode(float $value, int $decimal_points = null): string
    {
        $value = $this->value($value, $decimal_points);

        $space = $this->symbolSpace() ? ' ' : '';

        $arguments = $this->symbolAfterValue() ?
            [$value, $space, $this->symbol(), $this->code()] :
            [$this->symbol(), $space, $value, $this->code()];

        return sprintf('%s%s%s %s', ...$arguments);
    }

    /**
     * Get label to be displayed with the select option.
     */
    public function label(): string
    {
        return $this->code().' ('.$this->symbol().')';
    }
}
