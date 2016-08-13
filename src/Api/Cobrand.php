<?php

namespace YodleeApi\Api;

class Cobrand extends ApiAbstract
{
    /**
     * Authenticate cobrand to get cobrand session token.
     *
     * @param string
     * @param string
     * @return bool
     */
    public function login($cobrandLogin, $cobrandPassword)
    {
        $url = $this->getEndpoint('/cobrand/login');

        $response = $this->httpClient->post($url, [
            'cobrandLogin'    => $cobrandLogin,
            'cobrandPassword' => $cobrandPassword
        ]);

        $response = json_decode($response);

        if (empty($response->session->cobSession)) {

            return false;
        }

        $this->sessionManager->setCobrandSessionToken(
            $response->session->cobSession
        );

        return true;
    }

    /**
     * Log cobrand out of the Yodlee system.
     *
     * This also unsets the cobrand and user session tokens from the session
     * manager.
     */
    public function logout()
    {
        $url = $this->getEndpoint('/cobrand/logout');

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $this->httpClient->post($url, null, $requestHeaders);

        $this->sessionManager->setUserSessionToken('');
        $this->sessionManager->setCobrandSessionToken('');
    }

    /**
     * Get the public key.
     *
     * @see https://developer.yodlee.com/apidocs/index.php#Encryption
     *
     * @return \stdClass
     */
    public function publicKey()
    {
        $url = $this->getEndpoint('/cobrand/publicKey');

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->get($url, $requestHeaders);

        $response = json_decode($response);

        return $response;
    }
}
