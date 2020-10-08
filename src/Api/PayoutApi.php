<?php
/**
 * PayoutApi
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

class PayoutApi extends Request
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
     * Get transaction details about wallet to bank transfer
     *
     * @param string $transactionReference Reference of the transaction
     * @return array
     */
    public function fetchTransferStatus(string $transactionReference)
    {
        return $this->sendRequest('transfer/bank/details', array(
            'transactionReference' => $transactionReference,
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Transfer funds from a wallet to a bank account
     *
     * @param string $bankCode Bank Code of the recipient bank
     * @param string $accountNumber Recipient's Account Number
     * @param string $accountName Recipient's Account Name
     * @param string $transactionReference Reference of the transaction
     * @param float $amount Transaction Amount
     * @param string $narration Description of the transaction
     * @return array
     */
    public function localBankTransfer(
        string $bankCode,
        string $accountNumber,
        string $accountName,
        string $transactionReference,
        float $amount,
        string $narration = ''
    ) {
        return $this->sendRequest('transfer/bank/account', array(
            'BankCode' => $bankCode,
            'AccountNumber' => $accountNumber,
            'AccountName' => $accountName,
            'TransactionReference' => $transactionReference,
            'Amount' => $amount,
            'Narration' => $narration,
        ));
    }
    
    /**
     * Gets Bank Account Information
     *
     * @param string $bankCode Bank Code of the recipient bank
     * @param string $accountNumber Recipient's Account Number
     * @return array
     */
    public function getAccountInfo(string $bankCode, string $accountNumber)
    {
        return $this->sendRequest('transfer/bank/account/enquire', array(
            'BankCode' => $bankCode,
            'AccountNumber' => $accountNumber,
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Gets List of Banks and their codes
     *
     * @return array
     */
    public function getBanks()
    {
        return $this->sendRequest('transfer/banks/all');
    }
    
    /**
     * Gets List of International Banks and their codes
     *
     * @param string $currency
     * @return array
     */
    public function getIntlBanks(string $currency)
    {
        return $this->sendRequest('transfer/international/banks', array(
            'currency' => $currency,
        ), 'GET');
    }
    
    /**
     * Gets List of Internation Branches and their ids
     *
     * @param string $bankId
     * @return array
     */
    public function getIntlBranches(string $bankId)
    {
        return $this->sendRequest('transfer/international/bank/branches', array(
            'id' => $bankId,
        ), 'GET');
    }
    
    /**
     * Get International Transfer Rates
     *
     * @param string $currency
     * @param string $amount
     * @return mixed
     */
    public function getIntlRates(string $currency, string $amount)
    {
        return $this->sendRequest('transfer/international/rates', array(
            'Amount' => $amount,
            'Currency' => $currency,
        ));
    }
    
    /**
     * Transfer funds from a wallet to an international bank account
     *
     * @param string $bankId Bank Id of the recipient bank
     * @param string $bankBranchId Branch Id of the recipient bank branch
     * @param string $bankName Branch Name of the recipient bank
     * @param string $accountNumber Recipient's Account Number
     * @param string $accountName Recipient's Account Name
     * @param string $currency Currency
     * @param float $amount Transaction Amount
     * @param string $narration Description of the transaction
     * @return array
     */
    public function intlBankTransfer(
        string $bankId,
        string $bankBranchId,
        string $bankName,
        string $accountNumber,
        string $accountName,
        string $currency,
        float $amount,
        string $narration = ''
    ) {
        return $this->sendRequest('transfer/international/transfer', array(
            'BankId' => $bankId,
            'BankBranchId' => $bankBranchId,
            'Bank' => $bankName,
            'AccountNo' => $accountNumber,
            'AccountName' => $accountName,
            'Currency' => $currency,
            'Amount' => $amount,
            'Narration' => $narration,
        ));
    }

    /**
     * Transfer funds from a wallet to an international mobile money account
     *
     * @param string $accountNumber Recipient's Number
     * @param string $receipient Recipient's Name
     * @param string $currency Currency
     * @param float $amount Transaction Amount
     * @return array
     */
    public function intlMobileTransfer(
        string $accountNumber,
        string $recipient,
        string $currency,
        float $amount
    ) {
        return $this->sendRequest('transfer/international/mobilemoney', array(
            'AccountNo' => $accountNumber,
            'Recipient' => $recipient,
            'Currency' => $currency,
            'Amount' => $amount,
        ));
    }
}
