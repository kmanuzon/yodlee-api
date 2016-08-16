<?php

namespace YodleeApi;

use YodleeApi\Api\Cobrand;
use YodleeApi\Api\Providers;
use YodleeApi\Api\ProviderAccounts;
use YodleeApi\Api\Statements;
use YodleeApi\Api\Transactions;
use YodleeApi\Api\User;

class Client
{
    /**
     * The session manager instance.
     *
     * Handles the current session of the cobrand so we can share it throughout
     * the other API classes.
     *
     * @var \YodleeApi\SessionManager
     */
    private $sessionManager;

    /**
     * The HTTP Client instance.
     *
     * Handles the HTTP requests to the API.
     *
     * @var \YodleeApi\HttpClient
     */
    private $httpClient;

    /**
     * Create a new API client instance.
     *
     * @param string
     */
    public function __construct($apiUrl)
    {
        if (empty($apiUrl)) {

            throw new \Exception('Missing required argument $apiUrl (Yodlee API URL).');
        }

        $this->sessionManager = new SessionManager($apiUrl);
        $this->httpClient = new HttpClient();
    }

    /**
     * Get the cobrand API.
     *
     * @return \YodleeApi\Api\Cobrand
     */
    public function cobrand()
    {
        return new Cobrand($this->sessionManager, $this->httpClient);
    }

    /**
     * Get the providers API.
     *
     * @return \YodleeApi\Api\Providers
     */
    public function providers()
    {
        return new Providers($this->sessionManager, $this->httpClient);
    }

    /**
     * Get the providers API.
     *
     * @return \YodleeApi\Api\ProviderAccounts
     */
    public function providerAccounts()
    {
        return new ProviderAccounts($this->sessionManager, $this->httpClient);
    }

    /**
     * Get the statements API.
     *
     * @return \YodleeApi\Api\Statements
     */
    public function statements()
    {
        return new Statements($this->sessionManager, $this->httpClient);
    }

    /**
     * Get the transactions API.
     *
     * @return \YodleeApi\Api\Transactions
     */
    public function transactions()
    {
        return new Transactions($this->sessionManager, $this->httpClient);
    }

    /**
     * Get the user API.
     *
     * @return \YodleeApi\Api\User
     */
    public function user()
    {
        return new User($this->sessionManager, $this->httpClient);
    }
}
