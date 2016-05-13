<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (! ini_get('date.timezone')) {
    date_default_timezone_set('America/New_York');
}

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$yodlee = new \Yodlee\Api\Factory(getenv('COBRAND_NAME'));

// cobrand login.
$cobrandLogin = $yodlee->cobrand()->postLogin(getenv('COBRAND_LOGIN'), getenv('COBRAND_PASSWORD'));
print '$cobrandLogin<pre>';
var_dump($cobrandLogin);
print '</pre>';
print 'getCobrandSessionToken()<pre>';
var_dump($yodlee->getSessionToken()->getCobrandSessionToken());
print '</pre>';

// user login.
$userLogin = $yodlee->user()->postLogin(getenv('USER_LOGIN'), getenv('USER_PASSWORD'));
print '$userLogin<pre>';
var_dump($userLogin);
print '</pre>';
print 'getUserSessionToken()<pre>';
var_dump($yodlee->getSessionToken()->getUserSessionToken());
print '</pre>';
