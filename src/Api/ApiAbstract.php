<?php

namespace YodleeApi\Api;

use YodleeApi\HttpClient;
use YodleeApi\SessionManager;

abstract class ApiAbstract
{
    const CONTAINER_NAME_BANK = 'bank';
    const CONTAINER_NAME_CREDIT_CARD = 'creditCard';

    const TRANSACTION_BASE_TYPE_CREDIT = 'CREDIT';
    const TRANSACTION_BASE_TYPE_DEBIT = 'DEBIT';

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
     * @param array
     * @return string
     */
    protected function getEndpoint($path, array $parameters = [])
    {
        $apiUrl = rtrim($this->sessionManager->getApiUrl(), '/');
        $path = ltrim($path, '/');

        // add query string to endpoint.
        if (empty($parameters)) {
            $queryString = '';
        } else {
            $glue = strpos($apiUrl, '?') ? '&' : '?';
            $queryString = sprintf('%s%s', $glue, http_build_query($parameters));
        }

        $endpoint = sprintf('%s/%s%s', $apiUrl, $path, $queryString);

        return $endpoint;
    }
}
