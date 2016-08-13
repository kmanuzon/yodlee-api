<?php

namespace YodleeApi\Api;

class ProviderAccounts extends ApiAbstract
{
    /**
     * Fetch the provider account by ID.
     *
     * @param int
     * @return \stdClass
     */
    public function find($providerAccountId)
    {
        $url = $this->getEndpoint('/providers/providerAccounts/' . $providerAccountId);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->providerAccount)) {

            return new \stdClass;
        }

        return $response->providerAccount;
    }

    /**
     * Fetch all added provider accounts by the authenticated user.
     *
     * @return array
     */
    public function get()
    {
        $url = $this->getEndpoint('/providers/providerAccounts');

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->providerAccount)) {

            return [];
        }

        return $response->providerAccount;
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
        $url = $this->getEndpoint('/providers/providerAccounts', [
            'providerId' => $providerId
        ]);

        $parameters = ['field' => $fields];

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString(),
            'Content-Type: application/json'
        ];

        $response = $this->httpClient->post($url, $parameters, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->providerAccount)) {

            return new \stdClass;
        }

        return $response->providerAccount;
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
        $url = $this->getEndpoint('/providers/providerAccounts', [
            // value is comma separated provider account IDs.
            'providerAccountIds' => $providerAccountIds
        ]);

        $parameters = ['field' => $credentialsParam];

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->put($url, $parameters, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->providerAccount)) {

            return new \stdClass;
        }

        return $response->providerAccount;
    }

    /**
     * Delete the provider account.
     *
     * @param int
     */
    public function delete($providerAccountId)
    {
        $url = $this->getEndpoint('/providers/providerAccounts/' . $providerAccountId);

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $this->httpClient->delete($url, $requestHeaders);
    }
}
