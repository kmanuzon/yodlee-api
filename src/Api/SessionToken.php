<?php

namespace Yodlee\Api;

class SessionToken
{
    /**
     * The cobrand name.
     *
     * This will appear in the URL for API calls.
     *
     * @var string
     */
    protected $cobrandName;

    /**
     * The cobrand session token.
     *
     * @var string
     */
    protected $cobSession;

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
     * @param string
     * @param string
     */
    public function __construct($cobrandName = '', $cobSession = '', $userSession = '')
    {
        $this->setCobrandName($cobrandName);
        $this->setCobrandSessionToken($cobSession);
        $this->setUserSessionToken($userSession);
    }

    /**
     * Set the cobrand name.
     *
     * @param string
     */
    public function setCobrandName($cobrandName)
    {
        $this->cobrandName = $cobrandName;
    }

    /**
     * Get the cobrand name.
     *
     * @return string
     */
    public function getCobrandName()
    {
        return $this->cobrandName;
    }

    /**
     * Set cobrand session token.
     *
     * @param string
     */
    public function setCobrandSessionToken($cobSession)
    {
        $this->cobSession = $cobSession;
    }

    /**
     * Get cobrand session token.
     *
     * @return string
     */
    public function getCobrandSessionToken()
    {
        return $this->cobSession;
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
     * Builds authorization header.
     *
     * @return string
     */
    public function getAuthorizationHeader()
    {
        $tokens = [];

        if (! empty($this->getCobrandSessionToken())) {
            $tokens['cobSession'] = $this->getCobrandSessionToken();
        }

        if (! empty($this->getUserSessionToken())) {
            $tokens['userSession'] = $this->getUserSessionToken();
        }

        $keyVal = array_map(function($key, $value) {

            return sprintf('%s=%s', $key, $value);
        }, array_keys($tokens), $tokens);

        $header = sprintf('Authorization: {%s}', implode(',', $keyVal));

        return $header;
    }
}
