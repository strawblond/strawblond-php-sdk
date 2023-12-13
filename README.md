# StrawBlond PHP SDK

The StrawBlond PHP SDK provides convenient access to the StrawBlond API for PHP applications.

## Requirements
- PHP 8.1 and later

## Installation
You can install the library via Composer:

```sh
composer require strawblond/strawblond-php-sdk
```

## Usage
Basic usage looks something like this:
```php
$api = new StrawBlond\StrawBlond('YOUR_API_KEY');

// Get your user object
$user = $api->user()->me()->json();

// Retrieve an invoice
$invoice = $api->invoice()->get('jDe2KdWYK4')->json();

// Get all active projects
$projects = $api->project()->all(
    filters: ['status' => 'active', 'billing_type' => 'flat'],
    sort: 'last_time_tracked',
    include: ['company', 'times']
)->json('data');
```
