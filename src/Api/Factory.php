<?php

namespace Yodlee\Api;

use Yodlee\Api\Endpoints\Cobrand;
use Yodlee\Api\Endpoints\Providers;
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
     * @param string
     */
    public function __construct($cobrandName = '')
    {
        $this->getSessionToken()->setCobrandName($cobrandName);
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
        $endpoint = new Cobrand($this, $this->getSessionToken());

        return $endpoint;
    }

    /**
     * Get the providers endpoint.
     *
     * @return \Yodlee\Api\Endpoints\Providers
     */
    public function providers()
    {
        $endpoint = new Providers($this, $this->getSessionToken());

        return $endpoint;
    }

    /**
     * Get the transactions endpoint.
     *
     * @return \Yodlee\Api\Endpoints\Transactions
     */
    public function transactions()
    {
        $endpoint = new Transactions($this, $this->getSessionToken());

        return $endpoint;
    }

    /**
     * Get the user endpoint.
     *
     * @return \Yodlee\Api\Endpoints\User
     */
    public function user()
    {
        $endpoint = new User($this, $this->getSessionToken());

        return $endpoint;
    }
}
