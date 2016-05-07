<?php

namespace Yodlee\Api;

abstract class Api
{
    /**
     * Base URL of the Yodlee API.
     *
     * @var string
     */
    protected $baseUrl = 'https://developer.api.yodlee.com/ysl';

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
     * Get the full URL to the endpoint.
     *
     * @param string
     * @param string
     * @return string
     */
    protected function getUrl($cobrandName, $endpoint)
    {
        $url = sprintf(
            '%s/%s/v1/%s',
            $this->getBaseUrl(),
            trim($cobrandName, '/'),
            trim($endpoint, '/')
        );

        return $url;
    }
}
