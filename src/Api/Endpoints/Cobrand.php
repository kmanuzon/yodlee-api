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
    public function login($cobrandLogin, $cobrandPassword)
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
     * @return bool
     */
    public function logout()
    {
        $url = $this->getUrl(static::COBRAND_LOGOUT_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('POST', $url, [], $headers);

        if (isset($result['error'])) {

            return false;
        }

        $this->getSessionToken()->setCobrandSessionToken('');

        return true;
    }

    /**
     * Get the public key for use with encrypting user credentials.
     *
     * @return string
     */
    public function getPublicKey()
    {
        $url = $this->getUrl(static::COBRAND_PUBLIC_KEY_ENDPOINT);

        $headers = [
            $this->getSessionToken()->getAuthorizationHeader()
        ];

        $result = Curl::dispatch('GET', $url, [], $headers);

        if (isset($result['error'])) {

            return false;
        }

        return $result['body'];
    }
}
