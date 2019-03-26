<?php

namespace Tests;

use PulkitJalan\Google\Facades\Google;
use PulkitJalan\Google\GoogleServiceProvider;
use Tipy\Google\Sheets\Facades\Sheets;
use Tipy\Google\Sheets\Providers\SheetsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SheetsServiceProvider::class,
            GoogleServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Sheets' => Sheets::class,
            'Google' => Google::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
