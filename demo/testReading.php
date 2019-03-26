<?php

use Tipy\Google\Sheets\Sheets;

require './../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create('./..');
$dotenv->load();

// setup client
$client = new Google_Client();
$client->setScopes([Google_Service_Sheets::DRIVE, Google_Service_Sheets::SPREADSHEETS]);
$client->setClientId(getenv('GOOGLE_API_ID_CLIENT'));
$client->setClientSecret(getenv('GOOGLE_API_SECRET_CLIENT'));
$client->refreshToken(getenv('GOOGLE_API_TOKEN_REFRESH'));

// setup service
$service = new Google_Service_Sheets($client);

// sheet
$sheets = new Sheets();
$sheets->setService($service);

$values = $sheets->spreadsheet('1cuOTkfwm9TppJPcs64OcHpKZfpInmYz4zreqfqnxCeI')
    ->sheet('données brutes auto')
    ->all();

echo "<pre>";
var_dump($values);
echo "</pre>";