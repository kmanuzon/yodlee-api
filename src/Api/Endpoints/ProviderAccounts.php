<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\RestClient\Curl;

class ProviderAccounts extends Api
{
    /**
     * Add a provider account for the authenticated user.
     *
     * Fields parameter structure:
     * $fields = [
     *     [
     *        "id" => 65499,
     *        "value" => "DAPI.site16441.7"
     *     ],
     *     [
     *        "id" => 65500,
     *        "value" => "site16441.7"
     *     ]
     * ];
     *
     * @param int
     * @param array $fields An array of id and value array.
     * @return stdClass
     */
    public function add($providerId, array $fields)
    {
        $url = $this->getUrl(static::PROVIDER_ACCOUNTS_ENDPOINT . '?providerId=' . $providerId);

        $parameters = ['field' => $fields];

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader(),
            'Content-Type: application/json'
        ];

        $result = Curl::dispatch('POST', $url, $parameters, $headers);

        if (isset($result['error'])) {

            return new \stdClass;
        }

        return $result['body']->providerAccount;
    }
}
