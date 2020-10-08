<?php
/**
 * IdentityApi
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
class IdentityApi extends Request
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
     * Gets information from bvn
     *
     * @param string $bvn Bvn
     * @return array
     */
    public function resolveBvn(string $bvn)
    {
        return $this->sendRequest('account/resolvebvn', array(
            'bvn' => $bvn,
            'content_type' => 'application/json',
        ));
    }
    
    /**
     * Gets information from bvn with extra details
     *
     * @param string $bvn Bvn
     * @return array
     */
    public function resolveBvnDetails(string $bvn)
    {
        return $this->sendRequest('account/resolvebvn/details', array(
            'bvn' => $bvn,
        ));
    }
}
