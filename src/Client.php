<?php

namespace YodleeApi;

use YodleeApi\Api\Cobrand;
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
}
