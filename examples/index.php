<?php
include('../vendor/autoload.php');

use Remeni\WalletsAfrica\Configuration;
use Remeni\WalletsAfrica\ApiException;
use Remeni\WalletsAfrica\WalletsAfrica;

$configuration = new Configuration([
    'publicKey' => 'uvjqzm5xl6bw',
    'secretKey' => 'hfucj5jatq8h',
    'currency' => 'NGN'
]);
$configuration->setBaseUrl('https://sandbox.wallets.africa/');
$WalletsAfrica = new WalletsAfrica($configuration);

try {
    $resolveBvn = $WalletsAfrica->identity->resolveBvnDetails('22231485915');

    var_dump($resolveBvn);
} catch (ApiException $e) {
    echo $e->getMessage();
}
