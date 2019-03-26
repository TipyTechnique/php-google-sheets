<?php

namespace Tipy\Google\Sheets\Facades;

use Illuminate\Support\Facades\Facade;
use Tipy\Google\Sheets\Contracts\Factory;

class Sheets extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
