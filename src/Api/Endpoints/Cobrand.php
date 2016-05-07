<?php

namespace Yodlee\Api\Endpoints;

use Yodlee\Api\Api;
use Yodlee\Api\Factory;
use Yodlee\RestClient\Curl;

class Cobrand extends Api
{
    /**
     * The API factory instance.
     *
     * @var \Yodlee\Api\Factory
     */
    protected $factory;

    /**
     * Create a new cobrand endpoint instance.
     *
     * @param \Yodlee\Api\Factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
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
        $endpoint = '/cobrand/login';

        $url = $this->getUrl($cobrandName, $endpoint);

        $result = Curl::callApi('POST', $url, [
            'cobrandName'     => $cobrandName,
            'cobrandLogin'    => $cobrandLogin,
            'cobrandPassword' => $cobrandPassword
        ]);

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
