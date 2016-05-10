<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\Api\Factory;
use Yodlee\Api\SessionToken;
use Yodlee\RestClient\Curl;

class Transactions extends Api
{
    const TRANSACTIONS_ENDPOINT = '/transactions';

    /**
     * Create a new transactions endpoint instance.
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
     * Get all the transactions of the user in session.
     *
     * @param array
     * @return \stdClass|bool
     */
    public function getTransactions(array $parameters = [])
    {
        $url = $this->getUrl(static::TRANSACTIONS_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, $parameters, $headers);

        if (isset($result['error'])) {

            return false;
        }

        return $result['body'];
    }
}
