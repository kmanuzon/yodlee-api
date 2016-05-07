<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Factory;

class Transactions
{
    /**
     * The API factory instance.
     *
     * @var \Yodlee\Api\Factory
     */
    protected $factory;

    /**
     * Create a new transactions endpoint instance.
     *
     * @param \Yodlee\Api\Factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get all the transactions of the user in session.
     *
     */
    public function getTransactions()
    {
    }
}
