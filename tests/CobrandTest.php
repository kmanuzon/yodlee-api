<?php

use phpunit\framework\TestCase;

class CobrandTest extends TestCase
{
    public function testLogin()
    {
        $yodlee = new \Yodlee\Api\Factory('');

        $result = $yodlee->cobrand()->login('', '');

        $this->assertInternalType('boolean', $result);
    }

    public function testLogout()
    {
        $yodlee = new \Yodlee\Api\Factory('');

        $result = $yodlee->cobrand()->logout();

        $this->assertInternalType('boolean', $result);
    }
}
