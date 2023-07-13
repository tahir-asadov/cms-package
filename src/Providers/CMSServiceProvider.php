<?php

namespace Tahir\CMS\Providers;

use Tahir\CMS\Console\Commands\Install;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{

    public function boot()
    {

        // bootstrap web services
        // listen for events
        // publish configuration files and database migration

        AboutCommand::add('TACMS', fn () => ['Version' => '1.0.0']);
        
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tacms');

        $this->publishes([
            __DIR__.'/../config/tacms.php' => config_path('tacms.php')
        ], 'tacms-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tacms'),
        ], 'tacms-view');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tacms-migrations');

        $this->publishes([
            __DIR__.'/../routes' => base_path('routes'),
        ], 'tacms-routes');
        
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            $this->commands([
                Install::class
            ]);
        }
    }

    public function register()
    {
        // extends functionality from other classes
        // register service providers
        // create singleton classes
        $this->mergeConfigFrom(
            __DIR__.'/../config/tacms.php', 'tacms'
        );

    }
}
