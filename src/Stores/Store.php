<?php

namespace SSD\Currency\Stores;

use Illuminate\Http\Request;

abstract readonly class Store
{
    /**
     * Store constructor.
     */
    public function __construct(protected Request $request, protected string $key, protected string $default)
    {
    }

    /**
     * Check if currency matches argument.
     */
    public function is(string $code): bool
    {
        return $this->get() == $this->value($code);
    }

    /**
     * Get current currency code.
     */
    abstract public function get(): string;

    /**
     * Format code.
     */
    protected function value(string $code): string
    {
        return strtoupper($code);
    }

    /**
     * Set currency.
     */
    abstract public function set(string $code): void;
}
