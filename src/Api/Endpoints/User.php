<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\RestClient\Curl;

class User extends Api
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
        $url = $this->getUrl(static::USER_LOGIN_ENDPOINT);

        $parameters = [
            'loginName' => $loginName,
            'password'  => $password
        ];

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('POST', $url, $parameters, $headers);

        if (isset($result['error'])) {

            return false;
        }

        $this->getSessionToken()->setUserSessionToken(
            $result['body']->user->session->userSession
        );

        return true;
    }

    /**
     * Log user out of the Yodlee system.
     *
     * @return bool
     */
    public function logout()
    {
        $url = $this->getUrl(static::USER_LOGOUT_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('POST', $url, [], $headers);

        if (isset($result['error'])) {

            return false;
        }

        $this->getSessionToken()->setUserSessionToken('');

        return true;
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
        $url = $this->getUrl(static::USER_REGISTER_ENDPOINT);

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

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('POST', $url, $parameters, $headers);

        if (isset($result['error'])) {

            return false;
        }

        $this->getSessionToken()->setUserSessionToken(
            $result['body']->user->session->userSession
        );

        return $result['body']->user->id;
    }

    /**
     * Delete the logged in user from Yodlee system under the cobrand.
     *
     * NOTE: This cannot be undone.
     *
     * @return bool
     */
    public function unregister()
    {
        $url = $this->getUrl(static::USER_UNREGISTER_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('DELETE', $url, [], $headers);

        if (isset($result['error'])) {

            return false;
        }

        $this->getSessionToken()->setUserSessionToken('');

        return true;
    }
}
