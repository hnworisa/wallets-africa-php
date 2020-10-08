# wallets-africa-php
A PHP wrapper for the [Wallets Africa](https://wallets.africa/) API

## Installation
Install the library using Composer. Please read the [Composer Documentation](https://getcomposer.org/doc/01-basic-usage.md) if you're unfamiliar with Composer or dependency managers in general.

```bash
composer require remeni/wallets-africa-php
```

## Usage
Before  using the Wallets Africa API, you'll need to request for API Keys at [Wallets Africa site](https://wallets.africa/)
```php
require('vendor/autoload.php');

use Remeni\WalletsAfrica\Configuration;
use Remeni\WalletsAfrica\ApiException;
use Remeni\WalletsAfrica\WalletsAfrica;

$configuration = new Configuration([
    'publicKey' => 'YOUR_PUBLIC_KEY',
    'secretKey' => 'YOUR_SECRET_KEY',
    'currency' => 'NGN'
]);
$client = new WalletsAfrica($configuration);

try {
    $response = $client->account->checkBalance();

    if ($response->getStatusCode() == 200) {
        // Successful
    }
} catch (ApiException $e) {
    if ($e->getResponseBody()) {
        // No response from the server
    } else {
        // Response was returned from the server
    }
}
```

### Supported API Calls
* Account
* Airtime
* Identity
* Wallet
* Payout


## Contributing
You can contribute to the project in multiple ways:
* Write Documentation
* Implement features
* Fix bugs
* Add unit and functional tests

### Code style and structure
The coding style must conform with [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md), the easiet way to apply the conventions is to install [PHP_CodeSniffer](https://pear.php.net/package/PHP_CodeSniffer)

## Additional resources
Additional resources are available at:
* [API Documentation](https://documenter.getpostman.com/view/10058163/SWLk4RPL?version=latest)
## License
The MIT License (MIT). Please see [License File](https://github.com/remeni/wallets-africa-php/blob/master/LICENSE) for more information.
