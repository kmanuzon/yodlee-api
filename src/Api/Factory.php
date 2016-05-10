<?php

namespace Yodlee\Api;

use Yodlee\Api\Endpoints\Cobrand;
use Yodlee\Api\Endpoints\Transactions;
use Yodlee\Api\Endpoints\User;

class Factory
{
    /**
     * The session token instance.
     *
     * @var \Yodlee\Api\SessionToken
     */
    protected $sessionToken;

    /**
     * Create a new API factory instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Get the session token instance.
     *
     * @return \Yodlee\Api\SessionToken
     */
    public function getSessionToken()
    {
        if (empty($this->sessionToken)) {
            $this->sessionToken = new SessionToken();
        }

        return $this->sessionToken;
    }

    /**
     * Get the cobrand endpoint.
     *
     * @return \Yodlee\Api\Endpoints\Cobrand
     */
    public function cobrand()
    {
        $cobrand = new Cobrand($this, $this->getSessionToken());

        return $cobrand;
    }

    /**
     * Get the user endpoint.
     *
     * @return \Yodlee\Api\Endpoints\User
     */
    public function user()
    {
        $user = new User($this, $this->getSessionToken());

        return $user;
    }

    /**
     * Get the transactions endpoint.
     *
     * @return \Yodlee\Api\Endpoints\Transactions
     */
    public function transactions()
    {
        $transactions = new Transactions($this, $this->getSessionToken());

        return $transactions;
    }
}
