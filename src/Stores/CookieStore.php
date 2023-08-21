<?php

namespace SSD\Currency\Stores;

readonly class CookieStore extends Store
{
    /**
     * Get current currency code.
     */
    public function get(): string
    {
        return $this->value($this->request->cookie(
            $this->key, $this->default
        ));
    }

    /**
     * Set currency.
     */
    public function set(string $code): void
    {
        cookie()->queue($this->key, $this->value($code));
    }
}
