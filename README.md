# Currency component for Laravel 5+

## Installation

Install the package using composer

```
composer require sebastiansulinski/laravel-currency
```

Once installed, run:

```
php artisan vendor:publish
```

This will add a new file `config/currency.php` with the following structure:

```
<?php

return [
    "key" => "currency",
    "default" => "gbp",
    "currencies" => [
        "gbp" => \SSD\Currency\Currencies\GBP::class,
        "usd" => \SSD\Currency\Currencies\USD::class,
        "eur" => \SSD\Currency\Currencies\EUR::class
    ]
];
```

The `key` is used as the session key, which stores the currently selected currency.
The `default` states the default currency.
The `currencies` contains a list of available currencies.

### Service Provider and Facade

To use the package with the IOC Container, add its `SSD\Currency\CurrencyServiceProvider` to the list of providers inside of the `config/app.php` under the `providers`:

```

'providers' => [
    ...

    SSD\Currency\CurrencyServiceProvider::class

]
```

To use it as a Facade, add it under the `aliases`:

```
'aliases' => [
    ...

    'Currency'  => SSD\Currency\CurrencyFacade::class
]
```

## Provider

By default, package makes use of `Cookie` facade to store the selected currency in the cookie, however you can change it to whatever other storage you'd like by simply implementing a new `Provider` which:

- extends `SSD\Currency\Providers\BaseProvider`
- and implements `SSD\Currency\Providers\ProviderContract`

There are 3 methods that the new Provider needs to implement - these are: `get`, `set` and `is`.
Please see `SSD\Currency\Providers\CookieProvider` to get a better idea.

Once you have a new implementation ready, create the new ServiceProvider and replace it within `config/app.php`.

## Adding more currencies

Package comes with 3 currencies out of the box: `GBP`, `USD`, `EUR`.

If you'd like to add more, first create a new currency class, which:

- extends `SSD\Currency\Currencies\BaseCurrency`
- and implements `SSD\Currency\Currencies\CurrencyContract`

For instance, implementation for Japanese Yen would be (assuming you keep your currencies under App\Components\Currencies namespace):

```
<?php namespace App\Components\Currencies;

use SSD\Currency\Currencies\BaseCurrency;
use SSD\Currency\Currencies\CurrencyContract;

class JPY extends BaseCurrency implements CurrencyContract
{
    /**
     * @var string
     */
    protected $prefix = '¥';

    /**
     * @var string
     */
    protected $postfix = 'JPY';
}
```

All you need to do now to be able to use it is to add it to the `config/currency.php` file:

```
<?php

return [
    "key" => "currency",
    "default" => "gbp",
    "currencies" => [
        "gbp" => \SSD\Currency\Currencies\GBP::class,
        "usd" => \SSD\Currency\Currencies\USD::class,
        "eur" => \SSD\Currency\Currencies\EUR::class,
        "jpy" => \App\Components\Currencies\JPY::class
    ]
];
```

## Usage examples

The most common way of displaying currencies is to either have them displayed as clickable buttons or as a form `select` menu, which is what I'm going to demonstrate below.

First let's create a form select element with all options displayed. We can either use a `Currency` facade or simply pull `currency` from within the container using `app('currency')`:

```
<form>
    <select id="currency">
        @foreach(app('currency')->options() as $option)
            <option value="/currency/{{ $option->value }}"{{ app('currency')->selected($option->value) }}>{{ $option->label }}</option>
        @endforeach
    </select>
</form>
```

Now we need have some JavaScript so that when the `change` event occurs, the call is made to the given route, where action of the controller sets the new currency and page reloads reflecting that change.

You can use [sebastiansulinski/ssd-select](https://www.npmjs.com/package/ssd-select) and bind its `call-reload` action with our `select` element somewhere from within your JavaScript files:

```
$('#currency').ssdSelect({
   action : 'call-reload'
});
```

Next we need to add the Controller with Action and Route for it:

```
// app/Http/routes.php

Route::get('currency/{currency_id}', 'CurrencyController@set');

```

```
// app/Http/Controllers/CurrencyController.php

<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;

use Currency;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    /**
     * Set currency cookie.
     *
     * @param Response $response
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function set(Response $response, $id)
    {
        return $response->withCookie(Currency::set($id));
    }
}

```

Now if you'd like to display price based on the selected currency, make sure that your model can provider an array of prices for a given item in the following format:

```
[
    'gbp' => 10.00,
    'eur' => 11.56,
    'usd' => 17.60,
    'jpy' => 18.50
]
```

Let's assume our `Product` model has a `prices()` method, which will return the array formatted as above. To use it with the currency you can now simply call:

```
/**
 * Array of prices.
 *
 * @return array
 */
public function prices()
{
    return [
        'gbp' => $this->price_gbp,
        'usd' => $this->price_usd,
        'eur' => $this->price_eur,
        'jpy' => $this->price_jpy
    ];
}

/**
 * Price formatted with the currency symbol.
 *
 * @return string
 */
public function priceDisplay()
{
    return Currency::withPrefix($this->prices(), null, 2);
}
```

The `priceDisplay()` method will return the price with the currency symbol i.e. `£10.00` (depending on the currently selected currency).

## Formatting methods

We have the following methods available on our `Currency` object:

- `decimal($values, $currency = null, $decimal_points = 2)` : gets the value and gives it back in the decimal format.
- `withPrefix($values, $currency = null, $decimal_points = 2)` : gets the value and gives it back with the currency symbol at the beginning.
- `withPostfix($values, $currency = null, $decimal_points = 2)` : gets the value and gives it back with the currency code at the end.
- `withPrefixAndPostfix($values, $currency = null, $decimal_points = 2)` : gets the value and gives it back with the currency symbol and code.

The above 4 methods accept 3 arguments:

- `$values` : either array as above or a single float / int
- `$currency` : `null` by default, which is when the currency will be taken from the cookie - otherwise, you can state what currency you'd like to use.
- `$decimal_points` : how many decimal points you'd like it to return the value with.

## More methods

- `options()` : returns an array of `SSD\Currency\Option` - each representing one currency. `SSD\Currency\Option` has 2 properties `value` and `label`.
- `selected($currency)` : to be used with `select option` element to make the given option `selected="selected"` if it is set as current.
- `get()` : gets currently selected currency.
- `set($currency)` : sets the currency.
- `is($currency)` : checks if the currency passed as argument is currently selected.