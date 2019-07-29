<?php

namespace Tipy\Google\Sheets\Traits;

use Google_Service;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Sheets_BatchUpdateSpreadsheetRequest;
use Google_Service_Sheets_Spreadsheet;
use Google_Service_Sheets_UpdateValuesResponse;

trait SheetsDrive
{
    /**
     * @var Google_Service_Drive
     */
    protected $drive;

    /**
     * @var Google_Service_Drive_DriveFile
     */
    protected $driveFile;

    /**
     * @param array $params
     *
     * @return array
     */
    public function spreadsheetList(array $params = []): array
    {
        // params
        $default = [
            'q' => "mimeType = 'application/vnd.google-apps.spreadsheet'"
        ];

        $default = count($params) > 0 ? array_replace_recursive($default, $params) : $default;

        $list = [];

        $files = $this->getDriveService()
            ->files
            ->listFiles($default)
            ->getFiles();

        foreach ($files as $file) {
            $list[$file->id] = $file->name;
        }

        return $list;
    }

    /**
     * @return Google_Service_Drive|Google_Service
     */
    public function getDriveService()
    {
        return $this->drive;
    }

    /**
     * @param array $properties
     * @param array $fileProperties
     *
     * @return mixed|Google_Service_Sheets_UpdateValuesResponse
     */
    public function addSpreadsheet(array $properties, array $fileProperties)
    {
        $title = $properties['title'];

        // create new spreadsheet
        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => [
                'title' => $title
            ]
        ]);

        $response = $this->getService()->spreadsheets->create(
            $spreadsheet,
            [
                'fields' => 'spreadsheetId'
            ]
        );

        $emptyFileMetadata = new Google_Service_Drive_DriveFile();
        $response = $this->getDriveFileService()->files->update(
            $response->spreadsheetId,
            $emptyFileMetadata,
            [
                'addParents' => $fileProperties['parent'],
                'fields' => 'id, parents'
            ]
        );

        return $response;
    }

    /**
     * @param array $properties
     *
     * @return mixed|Google_Service_Sheets_UpdateValuesResponse
     */
    public function addSheet(array $properties)
    {
        $title = $properties['title'];

        //Create New Sheet
        $batch = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(
            [
                'requests' => [
                    'addSheet' => [
                        'properties' => [
                            'title' => $title
                        ]
                    ]
                ]
            ]
        );

        $response = $this->getService()->spreadsheets
            ->batchUpdate($this->spreadsheetId, $batch);

        return $response;
    }

    /**
     * @param Google_Service_Drive|Google_Service $drive
     *
     * @return $this
     */
    public function setDriveService($drive)
    {
        $this->drive = $drive;

        return $this;
    }

    /**
     * @return Google_Service_Drive_DriveFile|Google_Service
     */
    public function getDriveFileService()
    {
        return $this->driveFile;
    }

    /**
     * @param Google_Service_Drive_DriveFile|Google_Service $drive
     *
     * @return $this
     */
    public function setDriveFileService($drive)
    {
        $this->driveFile = $drive;

        return $this;
    }
}
