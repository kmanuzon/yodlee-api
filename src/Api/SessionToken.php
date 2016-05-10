<?php

namespace Yodlee\Api;

class SessionToken
{
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
     */
    public function __construct($cobSession = '', $userSession = '')
    {
        $this->setCobrandSessionToken($cobSession);
        $this->setUserSessionToken($userSession);
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
}
