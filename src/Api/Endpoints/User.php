<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\Api\Factory;
use Yodlee\Api\SessionToken;
use Yodlee\RestClient\Curl;

class User extends Api
{
    const LOGIN_ENDPOINT = '/user/login';

    /**
     * Create a new user endpoint instance.
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
     * Authenticate user to get user session token.
     *
     * NOTE: The user session token expires in 30 minutes.
     *
     * @param string
     * @param string
     * @return bool
     */
    public function postLogin($loginName, $password)
    {
        $url = $this->getUrl(static::LOGIN_ENDPOINT);

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
     */
    public function postLogout()
    {
    }
}
