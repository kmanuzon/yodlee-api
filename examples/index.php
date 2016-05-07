<?php

require_once __DIR__ . '/../vendor/autoload.php';

$yodleeApi = new \Yodlee\Api\Factory();

$yodleeApi->cobrand()->postLogin();
$yodleeApi->user()->postLogin();
$yodleeApi->transactions()->getTransactions();
