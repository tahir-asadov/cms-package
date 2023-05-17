<?php

namespace Tahir\CMS\Providers;

use Tahir\CMS\Console\Commands\Install;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{

    public function boot()
    {
        AboutCommand::add('My CMS', fn () => ['Version' => '1.0.0']);
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cms');

        $this->publishes([
            __DIR__.'/../config/cms.php' => config_path('cms.php')
        ], 'cms-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/cms'),
        ], 'cms-view');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'cms-migrations');

        
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            $this->commands([
                Install::class
            ]);
        }
        // dd('boot');
        // bootstrap web services
        // listen for events
        // publish configuration files and database migration
    }

    public function register()
    {
        // extends functionality from other classes
        // register service providers
        // create singleton classes
        $this->mergeConfigFrom(
            __DIR__.'/../config/cms.php', 'cms'
        );

    }
}
