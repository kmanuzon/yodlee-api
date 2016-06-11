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
}
