<?php
/**
 * WalletApi
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

class WalletApi extends Request
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
     * Perform a debit on a sub wallet
     *
     * @param string $transactionReference A unique id for the transaction
     * @param float $amount Amount
     * @param string $phoneNumber Phone number of the wallet
     * @return array
     */
    public function debit(string $transactionReference, float $amount, string $phoneNumber)
    {
        return $this->sendRequest('wallet/debit', array(
            'transactionReference' => $transactionReference,
            'amount' => $amount,
            'phoneNumber' => $phoneNumber,
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Perform a credit on a sub wallet
     *
     * @param string $transactionReference A unique id for the transaction
     * @param float $amount Amount
     * @param string $phoneNumber Phone number of the wallet
     * @return array
     */
    public function credit(string $transactionReference, float $amount, string $phoneNumber)
    {
        return $this->sendRequest('wallet/credit', array(
            'transactionReference' => $transactionReference,
            'amount' => $amount,
            'phoneNumber' => $phoneNumber,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Generate a wallet
     *
     * @param string $firstName First name
     * @param string $lastName Last name
     * @param string $email Email
     * @param string $dateOfBirth Date of birth
     * @param string $currency Currency of the wallet
     * @return array
     */
    public function generate(
        string $firstName,
        string $lastName,
        string $email,
        string $dateOfBirth,
        string $currency = null
    ) {
        return $this->sendRequest('wallet/generate', array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'dateOfBirth' => $dateOfBirth,
            'currency' => is_null($currency) ? $this->configuration->getCurrency() : $currency,
        ));
    }

    /**
     * Retrieve account number tied to a wallet
     *
     * @param string $phoneNumber Phone number of the wallet
     * @return array
     */
    public function getAccountNumber(string $phoneNumber)
    {
        return $this->sendRequest('wallet/nuban', array(
            'phoneNumber' => $phoneNumber,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Set Password for a wallet
     *
     * @param string $phoneNumber Phone number of the wallet
     * @param string $password Wallet Password
     * @return array
     */
    public function setPassword(string $phoneNumber, string $password)
    {
        return $this->sendRequest('wallet/password', array(
            'phoneNumber' => $phoneNumber,
            'password' => $password,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Set Transaction Pin for a wallet
     *
     * @param string $phoneNumber Phone number of the wallet
     * @param string $transactionPin Wallet Transaction Pin
     * @return array
     */
    public function setPin(string $phoneNumber, string $transactionPin)
    {
        return $this->sendRequest('wallet/pin', array(
            'phoneNumber' => $phoneNumber,
            'transactionPin' => $transactionPin,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Retrieve a list of performed transactions within a specified time period
     *
     * @param string $phoneNumber Wallet Phone Number
     * @param string $dateFrom The initial date
     * @param string $dateTo The final date
     * @param integer $transactionPin Transaction Pin
     * @param integer $transactionType The type of transaction (Credit = 1, Debit = 2, All = 0 or 3)
     * @param string $currency The desired currency in which the wallet balance should be displayed in
     * @param integer $skip Transaction Items to skip
     * @param integer $take Size of transaction data
     * @return array
     */
    public function getTransactions(
        string $phoneNumber,
        string $dateFrom,
        string $dateTo,
        int $transactionPin = null,
        int $transactionType = 0,
        string $currency = null,
        int $skip = 0,
        int $take = 10
    ) {
        return $this->sendRequest('wallet/transactions', array(
            'phoneNumber' => $phoneNumber,
            'dateFrom' => date('Y-m-d', strtotime($dateFrom)),
            'dateTo' => date('Y-m-d', strtotime($dateTo)),
            'transactionPin' => $transactionPin,
            'transactionType' => $transactionType,
            'currency' => is_null($currency) ? $this->configuration->getCurrency() : $currency,
            'skip' => $skip,
            'take' => $take,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Update the bvn of a wallet
     *
     * @param string $phoneNumberPhone Number of wallet
     * @param string $bvn Bvn
     * @param string $dateOfBirth The user's date of birth
     * @return array
     */
    public function updateBvn(string $phoneNumber, string $bvn, string $dateOfBirth)
    {
        return $this->sendRequest('wallet/verifybvn', array(
            'phoneNumber' => $phoneNumber,
            'bvn' => $bvn,
            'dateOfBirth' => $dateOfBirth,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Get a particular wallet
     *
     * @param string $phoneNumber Wallet Phone Number
     * @return array
     */
    public function getUser(string $phoneNumber)
    {
        return $this->sendRequest('wallet/getuser', array(
            'phoneNumber' => $phoneNumber,
            'content_type' => 'application/json',
        ));
    }

    /**
     * Get the balance of the developer wallet in different currencies
     *
     * @param string $phoneNumber Wallet Phone Number
     * @param string $transactionPin Transaction Pin
     * @param string $currency Wallet Currency
     * @return array
     */
    public function getBalance(string $phoneNumber, int $transactionPin = null, string $currency = null)
    {
        return $this->sendRequest('wallet/balance', array(
            'phoneNumber' => $phoneNumber,
            'transactionPin' => $transactionPin,
            'Currency' => is_null($currency) ? $this->configuration->getCurrency() : $currency,
            'content_type' => 'application/json',
        ));
    }
}
