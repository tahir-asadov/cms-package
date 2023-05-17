<?php

namespace Tahir\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tahirasadlicms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install CMS Packages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Artisan::call('breeze:install');
        echo Artisan::queue('migrate');
    }
}
