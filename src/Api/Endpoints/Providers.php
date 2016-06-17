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
    public function get(array $parameters = [])
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
     * Get more detail about the provider, e.g. login form.
     *
     * @param int
     * @return stdClass
     */
    public function getDetail($providerId)
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
