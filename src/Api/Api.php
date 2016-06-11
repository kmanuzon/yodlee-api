<?php

namespace Yodlee\Api;

use Yodlee\Api\Factory;
use Yodlee\Api\SessionToken;

abstract class Api
{
    /**
     * Formatted string API endpoints.
     *
     * @var string
     */
    const COBRAND_LOGIN_ENDPOINT      = '/cobrand/login';
    const COBRAND_LOGOUT_ENDPOINT     = '/cobrand/logout';
    const COBRAND_PUBLIC_KEY_ENDPOINT = '/cobrand/publicKey';
    const PROVIDERS_ENDPOINT          = '/providers';
    const PROVIDERS_DETAIL_ENDPOINT   = '/providers/%s';
    const TRANSACTIONS_ENDPOINT       = '/transactions';
    const USER_LOGIN_ENDPOINT         = '/user/login';
    const USER_LOGOUT_ENDPOINT        = '/user/logout';
    const USER_REGISTER_ENDPOINT      = '/user/register';
    const USER_UNREGISTER_ENDPOINT    = '/user/unregister';

    /**
     * The API factory instance.
     *
     * @var \Yodlee\Api\Factory
     */
    protected $factory;

    /**
     * The session token instance.
     *
     * @var \Yodlee\Api\SessionToken
     */
    protected $sessionToken;

    /**
     * Base URL of the Yodlee API.
     *
     * @var string
     */
    protected $baseUrl = 'https://developer.api.yodlee.com/ysl';

    /**
     * Create a new endpoint instance.
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
     * Get the API factory instance.
     *
     * @return \Yodlee\API\Factory
     */
    protected function getFactory()
    {
        return $this->factory;
    }

    /**
     * Get the session token instance.
     *
     * @return \Yodlee\API\Factory
     */
    protected function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * Get the Base URL of Yodlee API.
     *
     * @return string
     */
    protected function getBaseUrl()
    {
        return trim($this->baseUrl, '/');
    }

    /**
     * Build the full URL to the endpoint.
     *
     * @param string
     * @return string
     */
    protected function getUrl($endpoint)
    {
        $url = vsprintf('%s/%s/v1/%s', [
            $this->getBaseUrl(),
            trim($this->getSessionToken()->getCobrandName(), '/'),
            trim($endpoint, '/')
        ]);

        return $url;
    }
}
