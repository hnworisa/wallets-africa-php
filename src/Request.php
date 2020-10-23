<?php
/**
 * Request
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
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Remeni\WalletsAfrica\Configuration;
use Remeni\WalletsAfrica\ApiException;

abstract class Request
{
    /**
     * @var \Remeni\WalletsAfrica\Configuration
     */
    protected $configuration;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $httpClient;

    /**
     * Constructor
     *
     * @param Configuration $conf
     */
    public function __construct(Configuration $conf)
    {
        $this->configuration = $conf;

        if ($conf->getClientInterface()) {
            $this->httpClient = $conf->getClientInterface();
        } else {
            $this->httpClient = new Client([
                'timeout'  => $this->configuration->getTimeout()
            ]);
        }
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $method
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Remeni\WalletsAfrica\ApiException
     */
    protected function sendRequest(string $url, array $data = [], string $method = 'POST')
    {
        $method = strtoupper($method);

        if (!in_array($method, Configuration::AVAILABLE_REQUEST_METHODS)) {
            throw new InvalidArgumentException('Unallowed request method type');
        }

        $options = [];
        $data['secretkey'] = $this->configuration->getSecretKey();

        $options['headers'] = [
            'authorization' => 'Bearer ' . $this->configuration->getPublicKey(),
            'accept'        => 'application/json'
        ];
        
        if (!empty($data) && $method === 'POST') {
            if (array_key_exists('content_type', $data) && $data['content_type'] == 'application/json') {
                $options['json'] = $data;
                unset($data['content_type']);
            } else {
                $options['form_params'] = $data;
            }
        } else {
            $url.= '?'.http_build_query($data, null, '&');
        }

        $url = $this->configuration->getBaseUrl(). $url;
        
        try {
            $response = $this->httpClient->request($method, $url, $options);
        } catch (ConnectException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                null,
                null
            );
        } catch (RequestException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                $e->hasResponse() ? $e->getResponse()->getHeaders() : null,
                $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null
            );
        }
        
        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 299) {
            throw new ApiException(
                sprintf(
                    '[%d] Error connecting to the API (%s)',
                    $statusCode,
                    $request->getUri()
                ),
                $statusCode,
                $response->getHeaders(),
                $response->getBody()
            );
        }

        return json_decode($response->getBody()->getContents(), TRUE);
    }

    /**
     * Set \GuzzleHttp\ClientInterface
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @return void
     */
    public function setHttpClient($client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
    * @return \GuzzleHttp\ClientInterface
    */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Sets \Remeni\WalletsAfrica\Configuration
     *
     * @param \Remeni\WalletsAfrica\Configuration $config
     * @return $this
     */
    public function setConfiguration(Configuration $config)
    {
        $this->configuration = $config;

        return $this;
    }

    /**
     * Gets \Remeni\WalletsAfrica\Configuration $this->configuration
     * @return \Remeni\WalletsAfrica\Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
}
