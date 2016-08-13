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
$response = $yodleeApi->providerAccounts()->add(16441, [
    [
        "id" => 65499,
        "value" => "DAPI.site16441.7"
    ],
    [
        "id" => 65500,
        "value" => "site16441.7"
    ]
]);

print 'RESULT<pre>';
print_r($response);
print '</pre>';
