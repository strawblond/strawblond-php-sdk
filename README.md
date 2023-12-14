# StrawBlond PHP SDK

The StrawBlond PHP SDK provides convenient access to the StrawBlond API for PHP applications.

## Requirements

-   PHP 8.1 and later

## Installation

You can install the library via Composer:

```sh
composer require strawblond/strawblond-php-sdk
```

## Getting started

Basic usage looks something like this:

```php
// Initialize a new SDK client using your API key
$api = new StrawBlond\StrawBlond('YOUR_API_KEY');

// Get your user object
$user = $api->user()->me()->json();

// Retrieve an invoice
$invoice = $api->invoice()->get('jDe2KdWYK4')->json();

// Get all invoices
$invoices = $api->invoice()->all()->json('data');
```

The StrawBlond API uses personal API keys to authenticate incoming requests. You can view and manage your API keys in the [User Settings](https://app.strawblond.com/user/integrations). Your API keys carry the same permissions as your regular user account, so be sure to keep them secure!

> [!IMPORTANT]
> An API key acts as your user in a specific organization. You cannot access multiple organizations with a single key.

## Resources
The SDK gives you access to all resources documented on https://developers.strawblond.com/.
```php
$api = new StrawBlond\StrawBlond('YOUR_API_KEY');

// CRUD resources
$api->contact();
$api->company();
$api->project();
$api->timeTracking();
$api->invoice();
$api->offer();
$api->documentElement();
$api->product();
$api->rate();
$api->unit();

// Special resources
$api->user();
$api->member();
$api->webhook();
```

### Available methods
All CRUD resources give you at least following request methods to call:

**Retrieve a single resource**
`get(string $id)`

**Get a list of resources**
`all(array $filters, array $include, string $sort, int $page)` 

**Create a new resource**
`create(array $data)`

**Update an existing resource**
`update(string $id, array $changes)`

**Delete a resource**
`delete(string $id)`

Consult our documentation at https://developers.strawblond.com for resources that expose additional methods (like `send()` on invoices and offers).

## Usage
Start by sending a request using one of the methods available on a resource.
In this example we're trying to fetch a single invoice given a invoice ID. The `get` method returns a `Response` object.
```php
$response = $api->invoice()->get('jDe2KdWYK4');
```

We can now check if the request was successful and use the fetched data in various ways:
```php
if ($response->ok()) {
    // Get the response data as an json decoded array
    $invoice = $response->json();

    // Same as `json` but gets a single value from the data
    $dueDate = $response->json('due_at');

    // Get the response data as a Laravel Collection. 
    // ! Requires `illuminate/collections` to be installed
    $lineItems = $response->collect('elements');
}
```

See [Responses](#responses) for more methods on the `Response` object.

### Filtering
When calling the `all` method on a resource, you may pass an `filters` array to the method. (See the API reference on https://developers.strawblond.com for which filters are allowed on a given resource)
```php
$projects = $api->project()->all(
    filters: [
        'status' => 'active', 
        'billing_type' => 'flat'
    ],
)->json('data');
```

### Sorting
When calling the `all` method on a resource, you may pass a `sort` key to the method. (See the API reference on https://developers.strawblond.com for which sort keys are allowed on a given resource)
```php
$projects = $api->project()->all(
    sort: 'starts_at'
)->json('data');
```
Sorting is **ascending by default** and can be reversed by adding a hyphen (**-**) to the start of the property name.
```php
$projects = $api->project()->all(
    sort: '-starts_at'
)->json('data');
```

### Including relations
When calling the `get` or `all` method on a resource, you may pass an `include` array to include related resources. (See the API reference on https://developers.strawblond.com for which resources are allowed to be included in a request)
```php
$projects = $api->project()->all(
    include: ['company', 'user']
)->json('data');
```
You may also use the dot notation to include nested relations (https://developers.strawblond.com/guide/intro.html#nested-includes)

### Pagination
The `all` method on most resources returns a paginated list of objects inside a `data` property. The `links` and `meta` properties contain information useful for retrieving more pages.

You can set the page using the `page` argument.
```php
$projects = $api->project()->all(
    page: 2,
)->json('data');
```

## Responses

After sending a request, the StrawBlond SDK resource will return a `Response` class. This response class contains many helpful methods for interacting with your HTTP response like seeing the HTTP status code and retrieving the body.

```php
$response = $api->invoice()->get('jDe2KdWYK4');

$response->status() // Returns the response status code
$response->headers() // Returns all response headers
$response->header('X-Something') // Returns a given header
$response->body() // Returns the raw response body as a string
$response->json() // Retrieves a JSON response body and json_decodes it into an array.
$response->collect() // Retrieves a JSON response body and json_decodes it into a Laravel Collection. Requires `illuminate/collections`.
$response->object() // Retrieves a JSON response body and json_decodes it into an object.

// Methods used to determine if a request was successful or not based on status code.
$response->ok();
$response->successful();
$response->redirect();
$response->failed();
$response->clientError();
$response->serverError();

// Will throw an exception if the response is considered "failed".
$response->throw();
```
