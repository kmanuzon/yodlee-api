<?php

namespace Yodlee\Api;

use Yodlee\Api\Endpoints\Cobrand;
use Yodlee\Api\Endpoints\Transactions;
use Yodlee\Api\Endpoints\User;

class Factory
{
    /**
     * Create a new API factory instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Get the cobrand endpoint.
     *
     * @return \Yodlee\Api\Endpoints\Cobrand
     */
    public function cobrand()
    {
        $cobrand = new Cobrand($this);

        return $cobrand;
    }

    /**
     * Get the user endpoint.
     *
     * @return \Yodlee\Api\Endpoints\User
     */
    public function user()
    {
        $user = new User($this);

        return $user;
    }

    /**
     * Get the transactions endpoint.
     *
     * @return \Yodlee\Api\Endpoints\Transactions
     */
    public function transactions()
    {
        $user = new Transactions($this);

        return $user;
    }
}
