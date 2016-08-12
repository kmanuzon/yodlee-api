<?php

namespace YodleeApi\Api;

class Providers extends ApiAbstract
{
    /**
     * Get all available providers.
     *
     * @param array
     * @return array
     */
    public function get(array $parameters = [])
    {
        $url = $this->getEndpoint('/providers', $parameters);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->provider)) {

            return [];
        }

        return $response->provider;
    }

    /**
     * Get more detail about the provider, e.g. login form.
     *
     * @param int
     * @return \stdClass
     */
    public function getDetail($providerId)
    {
        $url = $this->getEndpoint('/providers/' . $providerId);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->provider)) {

            return new \stdClass;
        }

        return $response->provider[0];
    }
}
