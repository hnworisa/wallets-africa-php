<?php
/**
 * Configuration
 * PHP version 7
 *
 * @category Class
 * @package Remeni\WalletsAfrica
 * @author Chinemerem Nworisa <hnworisa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Remeni\WalletsAfrica;

use InvalidArgumentException;
use GuzzleHttp\ClientInterface;

class Configuration
{
    const AVAILABLE_REQUEST_METHODS = ['GET', 'POST'];
    const AVAILABLE_CURRENCIES = ['NGN', 'USD', 'GHS', 'KES'];
    
    /**
     * @var string
     */
    private $baseUrl = 'https://api.wallets.africa/';

    /**
     * @var float
     */
    private $timeOut = 5.0;
    
    /**
     * @var string
     */
    private $publicKey;
    
    /**
     * @var string
     */
    private $secretKey;
    
    /**
     * @var string
     */
    private $currency;
    
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $clientInterface;
    
    /**
     * Constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->setPublicKey($params['publicKey']);
        $this->setSecretKey($params['secretKey']);
        $this->setCurrency($params['currency']);
    }
    
    /**
     * @param string $publicKey
     * @return $this
     */
    public function setPublicKey(string $publicKey)
    {
        if (!is_string($publicKey)) {
            throw new InvalidArgumentException('A valid public key must be provided');
        }
        
        $this->publicKey = $publicKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }
    
    /**
     * @param string $secretKey
     * @return $this
     */
    public function setSecretKey(string $secretKey)
    {
        if (!is_string($secretKey)) {
            throw new \InvalidArgumentException('A valid secret key must be provided');
        }
        
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency)
    {
        if (!is_string($currency) || !in_array($currency, self::AVAILABLE_CURRENCIES)) {
            throw new InvalidArgumentException('Currency must either be NGN, USD, GHS or KES');
        }
        
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $baseUrl
     * @return $this
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeOut = $timeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getTimeout()
    {
        return $this->timeOut;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $interface
     */
    public function setClientInterface(ClientInterface $interface)
    {
        $this->clientInterface = $interface;
    }

    public function getClientInterface()
    {
        return $this->clientInterface;
    }
}
