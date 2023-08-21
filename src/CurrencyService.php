<?php

namespace SSD\Currency;

use SSD\Currency\Stores\Store;

/**
 * Class Currency
 *
 *
 * @method string get()
 * @method void set(string $currency)
 * @method bool is(string $currency)
 */
readonly class CurrencyService
{
    public function __construct(private Store $store, private Config $config)
    {
    }

    /**
     * Convert value to decimal.
     *
     * @param  string|array  $values
     */
    public function decimal($values, string $currency = null, int $decimal_points = 2): string
    {
        [$className, $value] = $this->classAndValue($values, $currency);

        return (new $className)->decimal($value, $decimal_points);
    }

    /**
     * Get class and value.
     *
     * @param  string|array  $values
     */
    private function classAndValue($values, string $currency = null, bool $asFloat = true): array
    {
        $className = $this->getClass($currency);

        $value = is_array($values) ? $this->getValue($values, $currency) : $values;

        if ($asFloat && $this->config->value_as_integer) {
            $value = $value / 100;
        }

        return [$className, $value];
    }

    /**
     * Get class name.
     */
    private function getClass(string $code): string
    {
        return $this->config->currencies->filter(
            fn(string $currency) => $currency::code() === $code
        )->first() ?? $this->config->currencies->filter(
            fn(string $currency) => $currency::code() === $this->config->default
        );
    }

    /**
     * Get value.
     */
    private function getValue(array $values, string $currency = null): string
    {
        return $values[strtoupper($currency ?? $this->store->get())];
    }

    /**
     * Convert value to integer.
     *
     * @param  string|array  $values
     */
    public function integer($values, string $currency = null): int
    {
        [$className, $value] = $this->classAndValue($values, $currency, false);

        return (new $className)->integer($value);
    }

    /**
     * Display value as decimal with currency symbol.
     *
     * @param  string|array  $values
     */
    public function withSymbol($values, string $currency = null, int $decimal_points = null): string
    {
        [$className, $value] = $this->classAndValue($values, $currency);

        return (new $className)->withSymbol($value, $decimal_points);
    }

    /**
     * Display value as decimal with currency label.
     *
     * @param  string|array  $values
     */
    public function withCode($values, string $currency = null, int $decimal_points = null): string
    {
        [$className, $value] = $this->classAndValue($values, $currency);

        return (new $className)->withCode($value, $decimal_points);
    }

    /**
     * Display value as decimal with currency symbol and label.
     *
     * @param  string|array  $values
     */
    public function withSymbolAndCode($values, string $currency = null, int $decimal_points = null): string
    {
        [$className, $value] = $this->classAndValue($values, $currency);

        return (new $className)->withSymbolAndCode($value, $decimal_points);
    }

    /**
     * Get an array of available currencies.
     */
    public function options(): array
    {
        return $this->config->currencies->map(
            fn(string $currency) => new Option(new $currency)
        )->toArray();
    }

    /**
     * Selected attribute for currency select.
     */
    public function selected(string $code): string
    {
        if (!$this->store->is($code)) {
            return '';
        }

        return ' selected="selected"';
    }

    /**
     * Override call to the methods on the provider.
     */
    public function __call(string $name, array $arguments): mixed
    {
        return call_user_func_array([$this->store, $name], $arguments);
    }
}
