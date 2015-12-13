<?php namespace SSD\Currency;

use InvalidArgumentException;

use SSD\Currency\Providers\ProviderContract;

class Currency
{
    /**
     * @var ProviderContract
     */
    private $provider;

    /**
     * Currency constructor.
     *
     * @param ProviderContract $provider
     */
    public function __construct(ProviderContract $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Convert value to decimal.
     *
     * @param string|array $values
     * @param null $currency
     * @param int $decimal_points
     * @return mixed
     */
    public function decimal($values, $currency = null, $decimal_points = 2)
    {
        $className = $this->getClass($currency);

        $value = is_array($values) ? $this->getValue($values, $currency) : $values;

        return (new $className)->decimal($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency symbol.
     *
     * @param string|array $values
     * @param null $currency
     * @param null|int $decimal_points
     * @return
     */
    public function withPrefix($values, $currency = null, $decimal_points = null)
    {
        $className = $this->getClass($currency);

        $value = is_array($values) ? $this->getValue($values, $currency) : $values;

        return (new $className)->prefix($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency label.
     *
     * @param string|array $values
     * @param null $currency
     * @param null|int $decimal_points
     * @return mixed
     */
    public function withPostfix($values, $currency = null, $decimal_points = null)
    {
        $className = $this->getClass($currency);

        $value = is_array($values) ? $this->getValue($values, $currency) : $values;

        return (new $className)->postfix($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency symbol and label.
     *
     * @param string|array $values
     * @param null $currency
     * @param null|int $decimal_points
     * @return mixed
     */
    public function withPrefixAndPostfix($values, $currency = null, $decimal_points = null)
    {
        $className = $this->getClass($currency);

        $value = is_array($values) ? $this->getValue($values, $currency) : $values;

        return (new $className)->prefix_postfix($value, $decimal_points);
    }

    /**
     * Get class name.
     *
     * @param null $currency
     * @return mixed
     */
    private function getClass($currency = null)
    {
        $currency = ! is_null($currency) ? strtolower($currency) : $this->provider->get();

        return $this->provider->config->get('currencies')[$currency];
    }

    /**
     * Get value.
     *
     * @param array $values
     * @param null $currency
     * @return mixed
     */
    private function getValue(array $values, $currency = null)
    {
        $currency = ! is_null($currency) ? strtolower($currency) : $this->provider->get();

        $values = array_change_key_case($values);

        return $values[$currency];
    }

    /**
     * Get a an array of available currencies.
     *
     * @return array
     */
    public function options()
    {
        $currencies = $this->provider->config->get('currencies');

        $options = [];

        foreach($currencies as $key => $currency) {

            $options[] = new Option($key, new $currency);

        }

        return $options;
    }

    /**
     * Selected attribute for currency select.
     *
     * @param $currency
     * @return null|string
     */
    public function selected($currency)
    {
        if ( ! $this->provider->is($currency)) {
            return null;
        }

        return ' selected="selected"';
    }

    /**
     * Override call to the methods on the provider.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ( ! in_array($name, ['get', 'set', 'is'])) {
            throw new InvalidArgumentException("Invalid method name");
        }

        return call_user_func_array([$this->provider, $name], $arguments);
    }
}