<?php namespace SSD\Currency\Currencies;

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
     * @param $value
     * @param int $decimal_points
     * @return string
     */
    public function decimal($value, $decimal_points = 2)
    {
        return number_format($value, $decimal_points);
    }

    /**
     * Display value as decimal
     * with currency symbol.
     *
     * @param $value
     * @param null $decimal_points
     * @return mixed
     */
    public function prefix($value, $decimal_points = null)
    {
        $value = is_null($decimal_points) ? $value : $this->decimal($value, $decimal_points);

        return $this->prefix . $value;
    }

    /**
     * Display value as decimal
     * with currency label.
     *
     * @param $value
     * @param null $decimal_points
     * @return mixed
     */
    public function postfix($value, $decimal_points = null)
    {
        $value = is_null($decimal_points) ? $value : $this->decimal($value, $decimal_points);

        return $value . ' ' . $this->postfix;
    }

    /**
     * Display value as decimal
     * with currency symbol and label.
     *
     * @param $value
     * @param null $decimal_points
     * @return mixed
     */
    public function prefix_postfix($value, $decimal_points = null)
    {
        $value = is_null($decimal_points) ? $value : $this->decimal($value, $decimal_points);

        return $this->prefix . $value . ' ' . $this->postfix;
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