<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Factory;

class Cobrand
{
    /**
     * The API factory instance.
     *
     * @var \Yodlee\Api\Factory
     */
    protected $factory;

    /**
     * Create a new cobrand endpoint instance.
     *
     * @param \Yodlee\Api\Factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Authenticate cobrand to get cobrand session token.
     *
     */
    public function postLogin()
    {
    }

    /**
     * Log cobrand out of the Yodlee system.
     *
     */
    public function postLogout()
    {
    }
}
