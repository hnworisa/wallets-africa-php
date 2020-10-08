<?php
/**
 * WalletsAfrica
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

use Remeni\WalletsAfrica\Configuration;
use Remeni\WalletsAfrica\Api\AccountApi;
use Remeni\WalletsAfrica\Api\WalletApi;
use Remeni\WalletsAfrica\Api\PayoutApi;
use Remeni\WalletsAfrica\Api\AirtimeApi;
use Remeni\WalletsAfrica\Api\IdentityApi;

class WalletsAfrica
{
    public $account;
    public $wallet;
    public $payout;
    public $airtime;
    public $identity;
    
    /**
     * Constructor.
     * @param \Remeni\WalletsAfrica\Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->account = new AccountApi($configuration);
        $this->wallet = new WalletApi($configuration);
        $this->payout = new PayoutApi($configuration);
        $this->airtime = new AirtimeApi($configuration);
        $this->identity = new IdentityApi($configuration);
    }
}
