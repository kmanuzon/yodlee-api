<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\Api\Factory;
use Yodlee\Api\SessionToken;
use Yodlee\RestClient\Curl;

class Transactions
{
    /**
     * Create a new transactions endpoint instance.
     *
     * @param \Yodlee\Api\Factory
     * @param \Yodlee\Api\SessionToken
     */
    public function __construct(Factory $factory, SessionToken $sessionToken)
    {
        $this->factory = $factory;
        $this->sessionToken = $sessionToken;
    }

    /**
     * Get all the transactions of the user in session.
     *
     */
    public function getTransactions()
    {
    }
}
