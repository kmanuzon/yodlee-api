<?php

namespace YodleeApi\Api;

class Transactions extends ApiAbstract
{
    /**
     * Get all the transactions of the user in session.
     *
     * @param array
     * @return array
     */
    public function get(array $parameters = [])
    {
        $url = $this->getEndpoint('/transactions', $parameters);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->transaction)) {

            return [];
        }

        return $response->transaction;
    }
}
