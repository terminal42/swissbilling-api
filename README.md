# SwissBilling API Client

An API client for [SwissBilling](https://www.swissbilling.ch) written in PHP.

**ATTENTION:** This repo is still in early development and subject to changes!


## Installing

```
composer require terminal42/swissbilling-api
```


## Usage

### Basics

Use the `Client` object to interact with the API. All API types have DocBlock properties, so a smart IDE (like PhpStorm)
will give you autocomplete support on the properties.

```php
use Terminal42\SwissbillingApi\Client;
use Terminal42\SwissbillingApi\Api\ApiFactory;
use Terminal42\SwissbillingApi\Type\Debtor;
use Terminal42\SwissbillingApi\Type\Merchant;
use Terminal42\SwissbillingApi\Type\InvoiceItem;
use Terminal42\SwissbillingApi\Type\Transaction;
use Terminal42\SwissbillingApi\Type\TransactionStatus;

$client = new Client(new ApiFactory());

$merchant = new Merchant('user', 'password', 'success_url', 'cancel_url', 'error_url');

$transaction = new Transaction();
// fill in the required transaction properties
// $transaction->amount = 100;

$debtor = new Debtor();
// fill in the required debtor properties
// $transaction->firstname = 'John';
// $transaction->lastname = 'Doe';

$items = [
    new InvoiceItem(),
];

/** @var TransactionStatus $status */
$status = $client->request($transaction, $debtor, $items, $merchant);

var_dump($status->hasError());
```


### Multiple calls / Dependency Injection

You can pass the merchant information to the Client instead of passing it on every method call, 
e.g. if using this in a Symfony bundle with dependency injection.

```php
$merchant = new Merchant('user', 'password', 'success_url', 'cancel_url', 'error_url');
$client = new Client(new ApiFactory(), $merchant);

// No need to pass the merchant anymore
$status = $client->request($transaction, $debtor, $items);

```


## Software Best Practice

This repository is following [SemVer](https://semver.org). If you rely on a stable API, 
make sure to install a version tag. 


## License

Licensed under the [MIT license](https://github.com/terminal42/swissbilling-api/blob/master/LICENSE).
