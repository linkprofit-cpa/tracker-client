<?php
require_once "vendor/autoload.php";

$connection = new \linkprofit\Tracker\Connection();

$connection->userName = '';
$connection->userPassword = '';
$connection->apiUrl = '';
$connection->accessLevel = \linkprofit\Tracker\AccessLevel::ADMIN;

$client = new \linkprofit\Tracker\Client($connection);
$client->connect();

$offers = new \linkprofit\Tracker\filter\OffersFilterBuilder();
$offers = $offers->isActive()->limit(10)->createRoute();

$response = $client->exec($offers);

var_dump($response->handle());
