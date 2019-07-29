<?php

namespace Tipy\Google\Sheets\Traits;

use Google_Service_Sheets_AppendValuesResponse;
use Google_Service_Sheets_BatchUpdateValuesRequest;
use Google_Service_Sheets_ClearValuesRequest;
use Google_Service_Sheets_ClearValuesResponse;
use Google_Service_Sheets_UpdateValuesResponse;
use Google_Service_Sheets_ValueRange;

trait SheetsValues
{
    /**
     * @var array
     */
    protected $ranges;

    /**
     * @var string
     */
    protected $majorDimension;

    /**
     * @var string
     */
    protected $valueRenderOption;

    /**
     * @var string
     */
    protected $dateTimeRenderOption;

    /**
     * @return array|null
     */
    public function first()
    {
        $values = $this->all();

        return array_shift($values);
    }

    /**
     * @return array|null
     */
    public function all()
    {
        $query = $this->query();

        $sheets = $this->getService()->spreadsheets_values
            ->batchGet($this->spreadsheetId, $query);

        $values = $sheets->getValueRanges()[0]->getValues();

        return $values;
    }

    /**
     * @return array
     */
    private function query(): array
    {
        $query = [];

        $ranges = $this->getRanges();

        if (!empty($ranges)) {
            $query['ranges'] = $ranges;
        }

        if (!empty($this->majorDimension)) {
            $query['majorDimension'] = $this->majorDimension;
        }

        if (!empty($this->valueRenderOption)) {
            $query['valueRenderOption'] = $this->valueRenderOption;
        }

        if (!empty($this->dateTimeRenderOption)) {
            $query['dateTimeRenderOption'] = $this->dateTimeRenderOption;
        }

        return $query;
    }

    /**
     * @return array
     */
    public function getRanges()
    {
        $ranges = [];

        if (empty($this->ranges)) {
            $ranges[] = $this->sheet;
        } else {
            foreach ($this->ranges as $range) {
                if (strpos($range, '!') === false) {
                    $ranges[] = $this->sheet.'!'.$range;
                } else {
                    $ranges[] = $range;
                }
            }
        }

        return $ranges;
    }

    /**
     * @param  array  $ranges
     *
     * @return $this
     */
    public function setRanges(array $ranges)
    {
        $this->ranges = $ranges;

        return $this;
    }

    /**
     * @param  array  $values
     * @param  string  $valueInputOption
     *
     * @return mixed|Google_Service_Sheets_UpdateValuesResponse
     */
    public function update(array $values, string $valueInputOption = 'RAW')
    {
        $ranges = $this->getRanges();

        $batch = new Google_Service_Sheets_BatchUpdateValuesRequest();
        $batch->setValueInputOption($valueInputOption);

        $data = [];
        foreach ($ranges as $key => $range) {
            $valueRange = new Google_Service_Sheets_ValueRange();
            $valueRange->setValues($values[$key]);
            $valueRange->setRange($range);
            $data[] = $valueRange;
        }

        $batch->setData($data);

        $response = $this->getService()->spreadsheets_values
            ->batchUpdate($this->spreadsheetId, $batch);

        return $response;
    }

    /**
     * @return mixed|Google_Service_Sheets_ClearValuesResponse
     */
    public function clear()
    {
        $ranges = $this->getRanges();

        $clear = new Google_Service_Sheets_ClearValuesRequest();

        $response = $this->getService()->spreadsheets_values
            ->clear($this->spreadsheetId, $ranges, $clear);

        return $response;
    }

    /**
     * @param  array  $value
     * @param  string  $valueInputOption
     * @param  string  $insertDataOption
     *
     * @return mixed|Google_Service_Sheets_AppendValuesResponse
     */
    public function append(array $value, string $valueInputOption = 'RAW', string $insertDataOption = 'OVERWRITE')
    {
        $ranges = $this->getRanges();

        $valueRange = new Google_Service_Sheets_ValueRange();
        $valueRange->setValues($value);
        $valueRange->setRange($ranges[0]);

        $optParams = [
            'valueInputOption' => $valueInputOption,
            'insertDataOption' => $insertDataOption,
        ];

        $response = $this->getService()->spreadsheets_values
            ->append($this->spreadsheetId, $ranges[0], $valueRange, $optParams);

        return $response;
    }

    /**
     * @param  string  $majorDimension
     *
     * @return $this
     */
    public function majorDimension(string $majorDimension)
    {
        $this->majorDimension = $majorDimension;

        return $this;
    }

    /**
     * @param  string  $dateTimeRenderOption
     *
     * @return $this
     */
    public function dateTimeRenderOption(string $dateTimeRenderOption)
    {
        $this->dateTimeRenderOption = $dateTimeRenderOption;

        return $this;
    }
}
