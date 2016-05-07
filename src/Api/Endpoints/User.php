<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Factory;

class User
{
    /**
     * The API factory instance.
     *
     * @var \Yodlee\Api\Factory
     */
    protected $factory;

    /**
     * Create a new user endpoint instance.
     *
     * @param \Yodlee\Api\Factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
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
