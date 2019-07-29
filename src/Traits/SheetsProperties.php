<?php

namespace Tipy\Google\Sheets\Traits;

use stdClass;

trait SheetsProperties
{
    /**
     * @return stdClass
     */
    public function spreadsheetProperties()
    {
        $properties = $this->getService()->spreadsheets->get($this->spreadsheetId)->getProperties()->toSimpleObject();

        return $properties;
    }

    /**
     * @return stdClass
     */
    public function sheetProperties()
    {
        $sheets = $this->getService()->spreadsheets->get($this->spreadsheetId, ['ranges' => $this->sheet])->getSheets();

        $properties = $sheets[0]->getProperties()->toSimpleObject();

        return $properties;
    }
}
