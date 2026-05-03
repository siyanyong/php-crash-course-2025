<?php

// require 'vendor/autoload.php';
// include in both the cli and webapp entry points
// require once to prevent possible class declaration errors
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
// Use this rather than get()
$response = $client->request('GET', 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
// Cast stream object to string, don't use getContents()
// $body = (string) $response->getBody();
// Make sure it's an associative array
// $data = json_decode($body, true);
$body = $response->getBody();
$data = json_decode($body);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bitcoin price in USD: <?php echo  $data->bitcoin->usd ?></h1>
</body>
</html>

<!--

composer require guzzlehttp/guzzle

Streams are consumable. If you do this:

$response->getBody()->getContents();
$response->getBody()->getContents(); // ← likely empty

The second call may return nothing unless you rewind the stream.

Yes, json_decode($response->getBody()) works because of __toString() implement by the stream class

But (string) is still a good habit for clarity and safety in production code

-->