<?php

namespace Devrabiul\MasterFileManager\Tests;

use Devrabiul\MasterFileManager\MasterFileManagerServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{

    protected function getPackageProviders($app)
    {
        return [
            MasterFileManagerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connection.testdb');
        $app['config']->set('database.connection.testdb', [
            'driver' => 'mysql',
            'database' => ':memory:',
        ]);
    }
}
