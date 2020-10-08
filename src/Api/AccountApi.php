<?php
/**
 * AccountApi
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

class AccountApi extends Request
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
     * Get the balance of the developer wallet in different currencies
     *
     * @param string $currency The desired currency in which the wallet balance should be displayed in
     * @return array
     */
    public function checkBalance(string $currency = null)
    {
        return $this->sendRequest('self/balance', array(
            'Currency' => is_null($currency) ? $this->configuration->getCurrency() : $currency,
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Retrieve a list of performed transactions within a specified time period
     *
     * @param string $dateFrom The initial date
     * @param string $dateTo The final date
     * @param integer $transactionType The type of transaction (Credit = 1, Debit = 2, All = 0 or 3)
     * @param string $currency The desired currency in which the wallet balance should be displayed in
     * @param integer $skip Transaction Items to skip
     * @param integer $take Size of transaction data
     * @return array
     */
    public function getTransactions(
        string $dateFrom,
        string $dateTo,
        int $transactionType = 0,
        string $currency = null,
        int $skip = 0,
        int $take = 10
    ) {
        return $this->sendRequest('self/transactions', array(
            'dateFrom' => date('Y-m-d', strtotime($dateFrom)),
            'dateTo' => date('Y-m-d', strtotime($dateTo)),
            'transactionType' => $transactionType,
            'currency' => is_null($currency) ? $this->configuration->getCurrency() : $currency,
            'skip' => $skip,
            'take' => $take,
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Update the bvn of your wallet
     *
     * @param string $bvn Bvn
     * @param string $dateOfBirth The user's date of birth
     * @return array
     */
    public function updateBvn(string $bvn, string $dateOfBirth)
    {
        return $this->sendRequest('self/verifybvn', array(
            'bvn' => $bvn,
            'dateOfBirth' => $dateOfBirth,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Get all wallets created
     *
     * @param integer $skip Items to skip
     * @param integer $take Items to take
     * @return array
     */
    public function getWallets(int $skip = null, int $take = null)
    {
        return $this->sendRequest('self/users', array(
            'skip' => $skip,
            'take' => $take,
            'content_type' => 'application/json',
        ));
    }
}
