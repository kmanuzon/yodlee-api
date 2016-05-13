<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\RestClient\Curl;

class Providers extends Api
{
    /**
     * Get all available providers.
     *
     * @param array
     * @return array
     */
    public function getProviders(array $parameters = [])
    {
        $url = $this->getUrl(static::PROVIDERS_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, $parameters, $headers);

        if (isset($result['error']) || empty($result['body']->provider)) {

            return [];
        }

        return $result['body']->provider;
    }

    /**
     * Get provider details.
     *
     * @param int
     * @return stdClass
     */
    public function getProvider($providerId)
    {
        $url = sprintf($this->getUrl(static::PROVIDERS_DETAIL_ENDPOINT), $providerId);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, [], $headers);

        if (isset($result['error']) || empty($result['body']->provider)) {

            return new \stdClass;
        }

        return $result['body']->provider[0];
    }
}
