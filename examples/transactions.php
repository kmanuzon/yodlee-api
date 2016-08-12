<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (! ini_get('date.timezone')) {
    date_default_timezone_set('America/New_York');
}

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$yodleeApi = new \YodleeApi\Client(getenv('YODLEEAPI_URL'));

$response = $yodleeApi->cobrand()->login(getenv('YODLEEAPI_COBRAND_LOGIN'), getenv('YODLEEAPI_COBRAND_PASSWORD'));
$response = $yodleeApi->user()->login(getenv('YODLEEAPI_USER_LOGIN'), getenv('YODLEEAPI_USER_PASSWORD'));
$response = $yodleeApi->transactions()->get([
    'fromDate' => '2000-01-01',
    'toDate'   => date('Y-m-d')
]);

print 'RESULT<pre>';
print_r($response);
print '</pre>';
