<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\RestClient\Curl;

class Cobrand extends Api
{
    /**
     * Authenticate cobrand to get cobrand session token.
     *
     * @param string
     * @param string
     * @return bool
     */
    public function postLogin($cobrandLogin, $cobrandPassword)
    {
        $url = $this->getUrl(static::COBRAND_LOGIN_ENDPOINT);

        $result = Curl::dispatch('POST', $url, [
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
