<?php

namespace SSD\Currency\Stores;

readonly class SessionStore extends Store
{
    /**
     * Get current currency code.
     */
    public function get(): string
    {
        return $this->value($this->request->session()->get(
            $this->key, $this->default
        ));
    }

    /**
     * Set currency.
     */
    public function set(string $code): void
    {
        $this->request->session()->put(
            $this->key, $this->value($code)
        );
    }
}
