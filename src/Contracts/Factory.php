<?php

namespace Tipy\Google\Sheets\Contracts;

use Google_Service;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Sheets;
use Google_Service_Sheets_AppendValuesResponse;
use Google_Service_Sheets_ClearValuesResponse;
use Google_Service_Sheets_UpdateValuesResponse;
use Illuminate\Support\Collection;
use stdClass;

interface Factory
{
    /**
     * @param  Google_Service_Sheets|Google_Service  $service
     */
    public function setService($service);

    /**
     * @return Google_Service_Sheets
     */
    public function getService(): Google_Service_Sheets;

    /**
     * set access_token and set new service
     *
     * @param  string|array  $token
     *
     * @return $this
     */
    public function setAccessToken($token);

    /**
     * @param  string  $spreadsheetId
     *
     * @return $this
     */
    public function spreadsheet(string $spreadsheetId);

    /**
     * @param  string  $title
     *
     * @return $this
     */
    public function spreadsheetByTitle(string $title);

    /**
     * @param  string  $sheet
     *
     * @return $this
     */
    public function sheet(string $sheet);

    /**
     * @param  string  $sheetId
     *
     * @return $this
     */
    public function sheetById(string $sheetId);

    /**
     * @return array
     */
    public function sheetList(): array;

    /**
     * @return Collection
     */
    public function get(): Collection;

    /**
     * @param  array  $header
     * @param  array|Collection  $rows
     *
     * @return Collection
     */
    public function collection(array $header, $rows): Collection;

    /**
     * @return array
     */
    public function spreadsheetList(): array;

    /**
     * @param  Google_Service_Drive|Google_Service  $drive
     */
    public function setDriveService($drive);

    /**
     * @return Google_Service_Drive|Google_Service
     */
    public function getDriveService();

    /**
     * @param  Google_Service_Drive_DriveFile|Google_Service  $drive
     */
    public function setDriveFileService($drive);

    /**
     * @return Google_Service_Drive_DriveFile|Google_Service
     */
    public function getDriveFileService();

    /**
     * @return stdClass
     */
    public function spreadsheetProperties();

    /**
     * @return stdClass
     */
    public function sheetProperties();

    /**
     * @return array|null
     */
    public function all();

    /**
     * @return array|null
     */
    public function first();

    /**
     * @param  array  $values
     * @param  string  $valueInputOption
     *
     * @return mixed|Google_Service_Sheets_UpdateValuesResponse
     */
    public function update(array $values, string $valueInputOption = 'RAW');

    /**
     * @return mixed|Google_Service_Sheets_ClearValuesResponse
     */
    public function clear();

    /**
     * @param  array  $value
     * @param  string  $valueInputOption
     * @param  string  $insertDataOption
     *
     * @return mixed|Google_Service_Sheets_AppendValuesResponse
     */
    public function append(array $value, string $valueInputOption = 'RAW', string $insertDataOption = 'OVERWRITE');

    /**
     * @return string
     */
    public function getRanges();

    /**
     * @param  array  $ranges
     *
     * @return $this
     */
    public function setRanges(array $ranges);

    /**
     * @param  string  $majorDimension
     *
     * @return $this
     */
    public function majorDimension(string $majorDimension);

    /**
     * @param  string  $dateTimeRenderOption
     *
     * @return $this
     */
    public function dateTimeRenderOption(string $dateTimeRenderOption);

    /**
     * @param  array  $properties
     *
     * @return mixed
     */
    public function addSheet(array $properties);

    /**
     * @param  array  $properties  Spreadsheet properties
     *
     * @param  array  $fileproperties
     * @return mixed
     */
    public function addSpreadsheet(array $properties, array $fileproperties);
}
