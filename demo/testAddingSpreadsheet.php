<?php

use Tipy\Google\Sheets\Sheets;

require './../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create('./..');
$dotenv->load();

// setup client
$client = new Google_Client();
$client->setScopes(
    [
        Google_Service_Sheets::DRIVE,
        Google_Service_Sheets::DRIVE_FILE,
        Google_Service_Sheets::SPREADSHEETS
    ]
);
$client->setClientId(getenv('GOOGLE_API_ID_CLIENT'));
$client->setClientSecret(getenv('GOOGLE_API_SECRET_CLIENT'));
$client->refreshToken(getenv('GOOGLE_API_TOKEN_REFRESH'));

// setup service
$service = new Google_Service_Sheets($client);

// sheet
$sheets = new Sheets();
$token = [
    'access_token'  => $user->access_token,
    'refresh_token' => $user->refresh_token,
    'expires_in'    => $user->expires_in,
    'created'       => $user->updated_at->getTimestamp(),
];
$sheets->setService($service);

$response = $sheets->addSpreadsheet(
    ['title' => 'Test'],
    ['parent' => '1x5P4TVrHMqAXthan0FsJMEu-E-xFrD8n']
);

echo "<pre>";
var_dump($response);
echo "</pre>";