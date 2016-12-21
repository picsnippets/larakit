<?php

namespace Buckii\Larakit;

use Illuminate\Support\ServiceProvider;

class LarakitProvider extends ServiceProvider
{
    public function boot()
    {
        // Register LaravelFormBuilder
        $this->app->register('Kris\LaravelFormBuilder\FormBuilderServiceProvider');
    }
}
