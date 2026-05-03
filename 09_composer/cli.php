<?php

// require 'vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';

use Zura\Testing\MyApp;
use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
// $body = (string)$response->getBody();
$body = $response->getBody(); // casting to string not necessary
$data = json_decode($body, true);

var_dump($data); // you do not have to echo var_dump
// echo 'Bitcoin price in USD: ' . $data->bitcoin->usd;
echo 'Bitcoin price in USD: ' . $data['bitcoin']['usd'];
echo "\n";

// instance of his class
$app = new MyApp();
$app->run();

echo "\n";

// Use of objects allows you to use the nullsafe operator without having to use isset:

$data = json_decode($body); // not associative array

echo 'Bitcoin price in USD: ' . ($data?->bitcoin?->usd ?? 'N/A');
// ?? tests isset or null

echo "\n";
