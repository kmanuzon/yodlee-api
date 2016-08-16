<?php

namespace YodleeApi\Api;

use YodleeApi\Entity\Statement as StatementEntity;

class Statements extends ApiAbstract
{
    /**
     * Get all the statements.
     *
     * @param array
     * @return array
     */
    public function get(array $parameters = [])
    {
        $url = $this->getEndpoint('/statements', $parameters);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->statement)) {

            return [];
        }

        return $response->statement;
    }
}
