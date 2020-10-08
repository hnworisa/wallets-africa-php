# wallets-africa-php
A PHP wrapper for the Wallets Africa API

## Installation
Install the library using Composer. Please read the [Composer Documentation](https://getcomposer.org/doc/01-basic-uage.md) if you're unfamiliar with Composer or dependency managers in general.

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
    'publicKey' => '********',
    'secretKey' => '********',
    'currency' => 'NGN'
]);
$client = new WalletsAfrica($configuration);

try {
    $balance = $client->account->checkBalance();
    print_r($balance);
} catch (ApiException $e) {
    echo $e->getMessage();
}
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
The MIT License (MIT). Please see [License File](https://github.com/remeni/wallets-africa-php/blob/master/LICENSE.md) for more information.
