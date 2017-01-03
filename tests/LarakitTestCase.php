<?php

namespace Buckii\LarakitTests;

use Orchestra\Testbench\TestCase;

abstract class LarakitTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app->make('Illuminate\Contracts\Http\Kernel')
            ->pushMiddleware('Illuminate\Session\Middleware\StartSession');

        $this->app['request']->setSession($this->app['session.store']);

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../migrations'),
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            'Buckii\Larakit\LarakitProvider',
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use pgsql (via docker).
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'pgsql',
            'database' => 'larakit',
            'host' => '127.0.0.1',
            'port' => 5432,
            'charset' => 'utf8',
            'prefix' => '',
            'username' => 'larakit',
            'password' => 'larakit',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ]);
    }
}
