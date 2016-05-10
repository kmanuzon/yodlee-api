<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\Api\Factory;
use Yodlee\Api\SessionToken;
use Yodlee\RestClient\Curl;

class Cobrand extends Api
{
    const COBRAND_LOGIN_ENDPOINT = '/cobrand/login';

    /**
     * Create a new cobrand endpoint instance.
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
     * Authenticate cobrand to get cobrand session token.
     *
     * @param string
     * @param string
     * @param string
     * @return bool
     */
    public function postLogin($cobrandName, $cobrandLogin, $cobrandPassword)
    {
        $url = $this->getUrl($cobrandName, static::COBRAND_LOGIN_ENDPOINT);

        $result = Curl::dispatch('POST', $url, [
            'cobrandName'     => $cobrandName,
            'cobrandLogin'    => $cobrandLogin,
            'cobrandPassword' => $cobrandPassword
        ]);

        if (isset($result['error'])) {

            return false;
        }

        $this->getSessionToken()->setCobrandSessionToken(
            $result['body']->session->cobSession
        );

        return true;
    }

    /**
     * Log cobrand out of the Yodlee system.
     *
     */
    public function postLogout()
    {
    }
}
