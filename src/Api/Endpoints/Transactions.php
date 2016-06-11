<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\RestClient\Curl;

class Transactions extends Api
{
    /**
     * Get all the transactions of the user in session.
     *
     * @param array
     * @return array
     */
    public function get(array $parameters = [])
    {
        $url = $this->getUrl(static::TRANSACTIONS_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, $parameters, $headers);

        if (isset($result['error']) || empty($result['body']->transaction)) {

            return [];
        }

        return $result['body']->transaction;
    }
}
