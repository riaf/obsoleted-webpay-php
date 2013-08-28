webpay-php
==========

[![Build Status](https://travis-ci.org/riaf/webpay-php.png?branch=master)](https://travis-ci.org/riaf/webpay-php) [![Coverage Status](https://coveralls.io/repos/riaf/webpay-php/badge.png)](https://coveralls.io/r/riaf/webpay-php)

WebPay PHP Bindings.


Getting Started
---------------

1. **Sign up for [WebPay](https://webpay.jp/)**
2. **Minimum requirements** - To run the SDK you will need *PHP 5.4+*
3. **Install the SDK** - Using [Composer](http://getcomposer.org/) is the recommended way to install the SDK. The SDK is available via [Packagist](http://packagist.org/) under the `webpay/webpay` package.


Quick Example
-------------

### Create a *Charge*

```php
<?php

require 'vendor/autoload.php';

use WebPay\WebPay;
use WebPay\Exception\WebPayException;

$webpay = new WebPay('YOUR API KEY HERE');

try {
    $charge = $webpay->api('charge.create', [
        'amount' => 1000,
        'card' => [
            'number' => '4242424242424242',
            'exp_month' => 9,
            'exp_year' => 2015,
            'cvc' => 946,
            'name' => 'KEISUKE SATO',
        ],
    ]);

    printf("CHARGE SUCCEED!: %s\n", charge['id']);

} catch (WebPayException $e) {
    printf("[%s] %s\n", get_class($e), $e->getMessage());

    // For more information
    // $response = $e->getResponse();
    // $data = $e->getData();
}
```


### Create a *Customer*

```php
<?php

require 'vendor/autoload.php';

use WebPay\WebPay;
use WebPay\Exception\WebPayException;

$webpay = new WebPay('YOUR API KEY HERE');

try {
    $customer = $webpay->api('customer.create', [
        'email' => 'sato.keisuke@facebook.com',
        'card' => [
            'number' => '4242424242424242',
            'exp_month' => 9,
            'exp_year' => 2015,
            'cvc' => 946,
            'name' => 'KEISUKE SATO',
        ],
    ]);

    printf("New customer: %s\n", $customer['id']);

} catch (WebPayException $e) {
    // ...
}
```

