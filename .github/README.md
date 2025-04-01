# PrintAPI SDK

Unofficial PHP SDK for PrintAPI built with [Saloon v3](https://github.com/saloonphp/saloon).

## Requirements

- PHP 8.3 or higher
- Composer

## Installation

```bash
composer require toktokdev/printapi-sdk
```

## Usage

Initialize the API client:

```php
use PrintAPI\PrintAPI;
  
$api = new PrintApi(
    clientId: 'your_client_id',
    clientSecret: 'your_client_secret',
    testMode: true // Use test environment
);
```

## API Implementation Status

| Category     | Endpoint                                      | Status        |
|--------------|-----------------------------------------------|---------------|
| **Orders**   |                                               |               |
|              | `POST /orders`                                | ✅ Implemented |
|              | `GET /orders/{id}`                            | ✅ Implemented |
|              | `GET /orders/{id}/status`                     | ✅ Implemented |
|              | `GET /orders?offset={offset}&limit={limit}`   | ✅ Implemented |
|              | `GET /sync/statuses?since={since}`            | ✅ Implemented |
| **Checkout** |                                               |               |
|              | `POST /checkout/{code}`                       | 🚧 Planned    |
|              | `GET /checkout/{code}`                        | 🚧 Planned    |
|              | `POST /coupons/quote`                         | 🚧 Planned    |
| **Shipping** |                                               |               |
|              | `POST /shipping/quote`                        | ✅ Implemented |
| **Uploads**  |                                               |               |
|              | `POST /files/{code}`                          | 🚧 Planned    |
| **Products** |                                               |               |
|              | `GET /products?offset={offset}&limit={limit}` | ✅ Implemented |
|              | `GET /products/{id}`                          | ✅ Implemented |

## Available Resources

Orders

```php
// Place an order
$order = $api->orders()->create($orderData);

// Get a single order
$order = $api->orders()->get('order_id');

// Get order status
$status = $api->orders()->getStatus('order_id');

// List orders (with pagination)
$orders = $api->orders()->list();

// Get status updates since date
$updates = $api->orders()->getStatusUpdates($since);

```

Products

```php
// List all products
$products = $api->products()->list();

// Get single product
$product = $api->products()->get('product_id');

```

Shipping

```php
// Get shipping quote
$quote = $api->shipping()->getQuote($quoteRequest);

```

# Development

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run code style fixer
composer lint

# Run static analysis
composer phpstan

```

# License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
