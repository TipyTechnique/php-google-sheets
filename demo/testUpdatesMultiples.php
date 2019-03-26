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

$response = $sheets->spreadsheet('1cuOTkfwm9TppJPcs64OcHpKZfpInmYz4zreqfqnxCeI')
    ->sheet('données brutes auto')
    ->setRanges(
        [
            'B2',
            'B3',
            'B4',
            'B5',
            'B6',
            'B7',
            'B8',
            'B9',
            'B10',
            'B11',
            'B12',
            'B13',
            'B16',
            'B17',
            'B18',
            'B19',
            'B20',
            'B21',
            'B22',
            'B23',
        ]
    )
    ->update(
        [
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '2'
                ]
            ],
            [
                [
                    '3'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '4'
                ]
            ],
            [
                [
                    '5'
                ]
            ],
            [
                [
                    '6'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '1'
                ]
            ],
            [
                [
                    '3'
                ]
            ]
        ]
    );

echo "<pre>";
var_dump($response);
echo "</pre>";