<?php

namespace YodleeApi\Api;

use YodleeApi\HttpClient;
use YodleeApi\SessionManager;

abstract class ApiAbstract
{
    /**
     * The session manager instance.
     *
     * Handles the current session of the cobrand so we can share it throughout
     * the other API classes.
     *
     * @var \YodleeApi\SessionManager
     */
    protected $sessionManager;

    /**
     * The HTTP Client instance.
     *
     * Handles the HTTP requests to the API.
     *
     * @var \YodleeApi\HttpClient
     */
    protected $httpClient;

    /**
     * Create a new API instance.
     *
     * @param \YodleeApi\Api\SessionManager
     * @param \YodleeApi\Api\HttpClient
     */
    public function __construct(SessionManager $sessionManager, HttpClient $httpClient)
    {
        $this->sessionManager = $sessionManager;
        $this->httpClient = $httpClient;
    }

    /**
     * Build the endpoint to the API.
     *
     * @param string
     * @return string
     */
    protected function getEndpoint($path)
    {
        $apiUrl = rtrim($this->sessionManager->getApiUrl(), '/');
        $path = ltrim($path, '/');

        return sprintf('%s/%s', $apiUrl, $path);
    }
}
