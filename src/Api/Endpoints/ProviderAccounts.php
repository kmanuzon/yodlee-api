<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\RestClient\Curl;

class ProviderAccounts extends Api
{
    /**
     * Fetch the provider account by ID.
     *
     * @param int
     * @return \stdClass
     */
    public function find($providerAccountId)
    {
        $url = $this->getUrl(sprintf('%s/%s', static::PROVIDER_ACCOUNTS_ENDPOINT, $providerAccountId));

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, [], $headers);

        if (isset($result['error'])) {

            return new \stdClass;
        }

        return $result['body']->providerAccount;
    }

    /**
     * Fetch all added provider accounts by the authenticated user.
     *
     * @return array
     */
    public function get()
    {
        $url = $this->getUrl(static::PROVIDER_ACCOUNTS_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, [], $headers);

        if (isset($result['error']) || empty($result['body']->providerAccount)) {

            return [];
        }

        return $result['body']->providerAccount;
    }

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
     * @return \stdClass
     */
    public function add($providerId, array $fields)
    {
        $url = $this->getUrl(sprintf('%s?providerId=%s', static::PROVIDER_ACCOUNTS_ENDPOINT, $providerId));

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

    /**
     * Update the provider account(s).
     *
     * @param string $providerAccountIds Comma separated provider account IDs
     * @param array
     * @return \stdClass
     */
    public function update($providerAccountIds, array $credentialsParam)
    {
        $url = $this->getUrl(sprintf('%s?providerAccountIds=%s', static::PROVIDER_ACCOUNTS_ENDPOINT, $providerAccountIds));

        $parameters = ['field' => $credentialsParam];

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('PUT', $url, $parameters, $headers);

        if (isset($result['error'])) {

            return new \stdClass;
        }

        return $result['body']->providerAccount;
    }

    /**
     * Delete the provider account.
     *
     * @param int
     * @return bool
     */
    public function delete($providerAccountId)
    {
        $url = $this->getUrl(sprintf('%s/%s', static::PROVIDER_ACCOUNTS_ENDPOINT, $providerAccountId));

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('DELETE', $url, [], $headers);

        if (isset($result['error'])) {

            return false;
        }

        return true;
    }
}
