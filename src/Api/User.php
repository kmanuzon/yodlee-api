<?php

namespace YodleeApi\Api;

class User extends ApiAbstract
{
    /**
     * Authenticate user to get user session token.
     *
     * NOTE: The user session token expires in 30 minutes.
     *
     * @param string
     * @param string
     * @return bool
     */
    public function login($loginName, $password)
    {
        $url = $this->getEndpoint('/user/login');

        $parameters = [
            'loginName' => $loginName,
            'password'  => $password
        ];

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->post($url, $parameters, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->user->session->userSession)) {

            return false;
        }

        $this->sessionManager->setUserSessionToken(
            $response->user->session->userSession
        );

        return true;
    }

    /**
     * Log user out of the Yodlee system.
     *
     * This also unsets the user session token from the session manager.
     */
    public function logout()
    {
        $url = $this->getEndpoint('/user/logout');

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $this->httpClient->post($url, null, $requestHeaders);

        $this->sessionManager->setUserSessionToken('');
    }

    /**
     * Register a user to Yodlee system under the cobrand and authenticate/login
     * on success.
     *
     * NOTE: This method returns user ID as integer or boolean false if it fails
     * to register.
     *
     * Password must be at least 8 characters long and contain at least one upper
     * case letter, one number and any of these special characters !@#$%^&*().
     * @see https://developer.yodlee.com/apidocs/index.php#!/user/register
     *
     * @param string
     * @param string
     * @param string
     * @return int|bool
     */
    public function register($loginName, $password, $email)
    {
        $url = $this->getEndpoint('/user/register');

        $userData = [
            'user' => [
                'loginName' => $loginName,
                'password'  => $password,
                'email'     => $email
            ]
        ];

        $parameters = [
            'registerParam' => json_encode($userData)
        ];

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $response = $this->httpClient->post($url, $parameters, $requestHeaders);

        $response = json_decode($response);

        if (empty($response->user->session->userSession)) {

            return false;
        }

        $this->sessionManager->setUserSessionToken(
            $response->user->session->userSession
        );

        return $response->user->id;
    }

    /**
     * Delete the authenticated user from Yodlee system under the cobrand.
     *
     * NOTE: This cannot be undone.
     */
    public function unregister()
    {
        $url = $this->getEndpoint('/user/unregister');

        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];

        $this->httpClient->delete($url, $requestHeaders);

        $this->sessionManager->setUserSessionToken('');
    }

    /**
     * Get inputs values for FastLink Support. Refer to Yodlee Api /user/accessTokens.
     * I prefer this from provider, more trustworthy for clients.
     *
     * NOTE: This method returns fastlink form inputs values or boolean false if it fails
     * to get.
     *
     *
     * @see https://developer.yodlee.com/apidocs/index.php#!/user/getAccessTokens
     *
     * @param int
     * @return array|bool
     */
    public function accessTokensIputs($app = 10003600)
    {
        $url = $this->getEndpoint('/user/accessTokens?appIds=' . $app);
        $requestHeaders = [
            $this->sessionManager->getAuthorizationHeaderString()
        ];
        $response = $this->httpClient->get($url, $requestHeaders);
        $response = json_decode($response);
        if(empty($response->user->accessTokens[0]->value)) {
            return false;
        }
        $inputs = [
            "app"           => $app,
            "rsession"      => $this->sessionManager->getUserSessionToken(),
            "token"         => $response->user->accessTokens[0]->value
        ];
        return $inputs;
    }
}
