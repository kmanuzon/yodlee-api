<?php

namespace YodleeApi;

class SessionManager
{
    /**
     * The API URL.
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * The cobrand session token.
     *
     * @var string
     */
    protected $cobrandSession;

    /**
     * The user session token.
     *
     * @var string
     */
    protected $userSession;

    /**
     * Constructor.
     *
     * @param string
     */
    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * Get API URL.
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Set cobrand session token.
     *
     * @param string
     */
    public function setCobrandSessionToken($cobrandSession)
    {
        $this->cobrandSession = $cobrandSession;
    }

    /**
     * Get cobrand session token.
     *
     * @return string
     */
    public function getCobrandSessionToken()
    {
        return $this->cobrandSession;
    }

    /**
     * Set user session token.
     *
     * @param string
     */
    public function setUserSessionToken($userSession)
    {
        $this->userSession = $userSession;
    }

    /**
     * Get user session token.
     *
     * @return string
     */
    public function getUserSessionToken()
    {
        return $this->userSession;
    }

    /**
     * Builds authorization header string.
     *
     * @return string
     */
    public function getAuthorizationHeaderString()
    {
        $tokens = [];

        if (! empty($this->getCobrandSessionToken())) {
            $tokens['cobSession'] = $this->getCobrandSessionToken();
        }

        if (! empty($this->getUserSessionToken())) {
            $tokens['userSession'] = $this->getUserSessionToken();
        }

        if (empty($tokens)) {

            return '';
        }

        $keyVal = array_map(function($key, $value) {

            return sprintf('%s=%s', $key, $value);
        }, array_keys($tokens), $tokens);

        $tokensString = implode(',', $keyVal);

        $header = sprintf('Authorization: {%s}', $tokensString);

        return $header;
    }
}
