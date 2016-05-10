<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\Api\Factory;
use Yodlee\Api\SessionToken;
use Yodlee\RestClient\Curl;

class User
{
    /**
     * Create a new user endpoint instance.
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
     * Authenticate user to get user session token.
     *
     * NOTE: The user session token expires in 30 minutes.
     */
    public function postLogin()
    {
    }

    /**
     * Log user out of the Yodlee system.
     *
     */
    public function postLogout()
    {
    }
}
