<?php
/**
 * AirtimeApi
 * PHP version 7
 *
 * @category Class
 * @package Remeni\WalletsAfrica
 * @author Chinemerem Nworisa <hnworisa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Remeni\WalletsAfrica\Api;

use Remeni\WalletsAfrica\Configuration;
use Remeni\WalletsAfrica\Request;

/**
 * Base class for Wallets Africa exceptions.
 */
class AirtimeApi extends Request
{
    /**
     * Constructor
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
    }
    
    /**
     * Get airtime providers
     *
     * @return array
     */
    public function getProviders()
    {
        return $this->sendRequest('bills/airtime/providers', array(
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Purchase Airtime
     *
     * @param string $providerCode Network provider code
     * @param string $phoneNumber Recipient's Phone Number
     * @param float $amount Airtime Amount
     * @return array
     */
    public function purchase(string $providerCode, string $phoneNumber, float $amount)
    {
        return $this->sendRequest('transfer/bank/account', array(
            'Code' => $providerCode,
            'PhoneNumber' => $phoneNumber,
            'Amount' => $amount,
            'content_type' => 'application/json',
        ));
    }
}
