<?php

namespace Tipy\Google\Sheets\Traits;

use Illuminate\Support\Collection;

trait SheetsCollection
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        $values = $this->all();

        return Collection::make($values);
    }

    /**
     * @param  array  $header
     * @param  array|Collection  $rows
     *
     * @return Collection
     */
    public function collection(array $header, $rows): Collection
    {
        $collection = [];

        if ($rows instanceof Collection) {
            $rows = $rows->toArray();
        }

        foreach ($rows as $row) {
            $col = [];

            foreach ($header as $index => $head) {
                $col[$head] = empty($row[$index]) ? '' : $row[$index];
            }

            if (!empty($col)) {
                $collection[] = $col;
            }
        }

        return Collection::make($collection);
    }
}
