# Currency component for Laravel 5+

[![Build Status](https://travis-ci.org/sebastiansulinski/laravel-currency.svg?branch=master)](https://travis-ci.org/sebastiansulinski/laravel-currency)

## Versions

As of version `v2.0.0` package requires PHP `7.1.3`, `v1.4.0` requires PHP `7.1` and for earlier versions of PHP, please use `v1.2.0`

## Installation

Install the package using composer

```
composer require sebastiansulinski/laravel-currency
```

### Service Provider and Facade

To use the package with the IOC Container, add its `SSD\Currency\CurrencyServiceProvider` to the list of providers inside of the `config/app.php` under the `providers`:

```php

'providers' => [
    ...

    SSD\Currency\CurrencyServiceProvider::class

]
```

To use it as a Facade, add it under the `aliases`:

```php
'aliases' => [
    ...

    'Currency'  => SSD\Currency\CurrencyFacade::class
]
```

now run:

```php
php artisan vendor:publish
```

This will add a new file `config/currency.php` with the following structure:

```php
<?php

return [
    "key" => "currency",
    "default" => \SSD\Currency\Currencies\GBP::code(),
    "currencies" => [
        \SSD\Currency\Currencies\GBP::class,
        \SSD\Currency\Currencies\USD::class,
        \SSD\Currency\Currencies\EUR::class,
    ],
    "value_as_integer" => false,
];
```

* The `key` is used as the session key, which stores the currently selected currency.
* The `default` states the default currency code.
* The `currencies` contains a list of available currencies.
* The `value_as_integer` indicates whether your prices are stored as integers or float / decimal.

## Provider

Package comes with two implementations / providers:

- `SSD\Currency\Providers\CookieProvider`, which stores selected currency in the encrypted cookie
- `SSD\Currency\Providers\SessionProvider`, which will store the selected currency using default session driver

You can create additional providers by:

- extending `SSD\Currency\Providers\BaseProvider`

There are 3 methods that the new Provider needs to implement - these are: `get`, `set` and `is`.
Please see `SSD\Currency\Providers\CookieProvider` to get a better idea.

Once you have a new implementation ready, create the new ServiceProvider and replace it within `config/app.php`.

## Adding more currencies

Package comes with 3 currencies out of the box: `GBP`, `USD`, `EUR`.

If you'd like to add more, first create a new currency class, which:

- extends `SSD\Currency\Currencies\BaseCurrency`

For instance, implementation for Japanese Yen would be (assuming you keep your currencies under App\Components\Currencies namespace):

```php
<?php 

namespace App\Components\Currencies;

use SSD\Currency\Currencies\BaseCurrency;

class JPY extends BaseCurrency
{
    /**
     * Get symbol.
     *
     * @return string
     */
    public static function symbol(): string
    {
        return '¥';
    }

    /**
     * Get code.
     *
     * @return string
     */
    public static function code(): string
    {
        return 'JPY';
    }
}
```

All you need to do now to be able to use it is to add it to the `config/currency.php` file:

```php
<?php

return [
    "key" => "currency",
    "default" => \SSD\Currency\Currencies\GBP::code(),
    "currencies" => [
        \SSD\Currency\Currencies\GBP::class,
        \SSD\Currency\Currencies\USD::class,
        \SSD\Currency\Currencies\EUR::class,
        \App\Components\Currencies\JPY::class,
    ],
    "value_as_integer" => false,
];
```

## Currencies with symbol after the value

Some currencies place symbol after the value. To indicate it you can overwrite the method `BaseCurrency::symbolAfterValue` and if you need a space between the symbol and value `BaseCurrency::symbolSpace`:

```php
<?php 

namespace App\Components\Currencies;

use SSD\Currency\Currencies\BaseCurrency;

class PLN extends BaseCurrency
{
    /**
     * Get symbol.
     *
     * @return string
     */
    public static function symbol(): string
    {
        return 'zł';
    }

    /**
     * Get code.
     *
     * @return string
     */
    public static function code(): string
    {
        return 'PLN';
    }

    /**
     * Determine if symbol should be placed after the value.
     *
     * @return bool
     */
    protected static function symbolAfterValue(): bool
    {
        return true;
    }

    /**
     * Determine if there is a space between symbol and the value.
     *
     * @return bool
     */
    protected static function symbolSpace(): bool
    {
        return true;
    }
}
```

The above class would now return `75.00 zł` with `withSymbol` and `75.00 zł PLN` with `withSymbolAndCode` methods.

## Usage examples

The most common way of displaying currencies is to either have them displayed as clickable buttons or as a form `select` menu, which is what I'm going to demonstrate below.

First let's create a form select element with all options displayed. We can either use a `Currency` facade or simply pull `currency` from within the container using `app('currency')`:

```html
<form>
    <select id="currency">
        @foreach(app('currency')->options() as $option)
            <option 
                value="/currency/{{ $option->value }}"
                {{ app('currency')->selected($option->value) }}
            >{{ $option->label }}</option>
        @endforeach
    </select>
</form>
```

Now we need have some JavaScript so that when the `change` event occurs, the call is made to the given route, where action of the controller sets the new currency and page reloads reflecting that change.

Simply bind `change` event to the `select` element using JavaScript:

```javascript
// vanilla JavaScript
(document.getElementById('currency')).addEventListener('change', function (event) {
    window.location.href = event.target.value;
});

// or using jQuery
$('#currency').on('change', function () {
    window.location.href = $(this).val();
});
```

Next we need to add the Controller with Action and Route for it:

```php
// app/Http/routes.php

Route::get('currency/{currency_id}', 'CurrencyController@set');

```

```php
// app/Http/Controllers/CurrencyController.php

<?php 

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use Currency;

class CurrencyController extends Controller
{
    /**
     * Set currency cookie.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function set($id)
    {
        Currency::set($id);

        return new JsonResponse(['success' => true]);
    }
}

```

Now if you'd like to display price based on the selected currency, make sure that your model can provider an array of prices for a given item in the following format:

```php
[
    'GBP' => 10.00,
    'EUR' => 11.56,
    'USD' => 17.60,
    'JPY' => 18.50
]

// or if you're using prices as integers

[
    'GBP' => 1000,
    'EUR' => 1156,
    'USD' => 1760,
    'JPY' => 1850
]
```

Let's assume our `Product` model has a `prices()` method, which will return the array formatted as above. To use it with the currency you can now simply call:

```php
/**
 * Array of prices.
 *
 * @return array
 */
public function prices()
{
    return [
        'GBP' => $this->price_gbp,
        'EUR' => $this->price_usd,
        'USD' => $this->price_eur,
        'JPY' => $this->price_jpy
    ];
}

/**
 * Price formatted with the currency symbol.
 *
 * @return string
 */
public function priceDisplay()
{
    return Currency::withSymbol($this->prices(), null, 2);
}
```

The `priceDisplay()` method will return the price with the currency symbol i.e. `£10.00` (depending on the currently selected currency).

## Formatting methods

We have the following methods available on our `Currency` object instance / facade:

- `decimal($values, $currency = null, $decimal_points = 2)` : gets the value and gives it back in the decimal format.
- `integer($values, $currency = null)` : gets the value as integer i.e. `20.53` will become `20`, but `2053` will be `2053`.
- `withSymbol($values, $currency = null, $decimal_points = null)` : gets the value and gives it back with the currency symbol at the beginning.
- `withCode($values, $currency = null, $decimal_points = null)` : gets the value and gives it back with the currency code at the end.
- `withSymbolAndCode($values, $currency = null, $decimal_points = null)` : gets the value and gives it back with the currency symbol and code.

Four of the above methods accept 3 arguments (`integer` method only first 2):

- `$values` : either array as above or a single float / int
- `$currency` : currency code - `null` by default, which is when the currency will be taken from the cookie - otherwise, you can state what currency you'd like to use.
- `$decimal_points` : how many decimal points you'd like it to return the value with.

## More methods

- `options()` : returns an array of `SSD\Currency\Option` - each representing one currency. `SSD\Currency\Option` has 2 properties `value` and `label`.
- `selected($currency)` : to be used with `select option` element to make the given option `selected="selected"` if it is set as current.
- `get()` : gets currently selected currency.
- `set($currency)` : sets the currency.
- `is($currency)` : checks if the currency passed as argument is currently selected.