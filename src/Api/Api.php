<?php

namespace Yodlee\Api;

abstract class Api
{
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
     * @param string
     * @return string
     */
    protected function getUrl($cobrandName, $endpoint)
    {
        $url = vsprintf('%s/%s/v1/%s', [
            $this->getBaseUrl(),
            trim($cobrandName, '/'),
            trim($endpoint, '/')
        ]);

        return $url;
    }
}
