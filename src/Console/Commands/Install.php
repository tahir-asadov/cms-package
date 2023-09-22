<?php

namespace Tahir\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tahirasadlicms:install {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install CMS Package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $is_first_run = false;
        $this->info('Publishing TACMS Assets...');
        $this->comment('Publishing TACMS Configs...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-config', '--force' => $this->option('force')]);

        $this->comment('Publishing TACMS Views...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-view', '--force' => $this->option('force')]);

        $this->comment('Publishing TACMS Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-css', '--force' => $this->option('force')]);
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-js', '--force' => $this->option('force')]);

        $this->comment('Publishing TACMS Migrations...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-migrations', '--force' => $this->option('force')]);

        $this->comment('Publishing TACMS Routes...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-routes', '--force' => $this->option('force')]);

        $this->info('TACMS scaffolding installed successfully.');
        
        $this->comment('Add npm packages...');
        Process::run('npm i @tahir-asadli/uploader');
        Process::run('npm i slugify');
        // $this->callSilent('npm i @tahir-asadli/uploader', ['--tag' => 'tacms-npm-uploader', '--force' => true]);
        // $this->callSilent('npm i slugify', ['--tag' => 'tacms-npm-slugify', '--force' => true]);
        
        $this->comment('Installing TACMS Routes...');

        $this->comment('Installing Breeze...');
        $this->call('breeze:install', ['stack' => 'blade']);
        $this->info('Breeze installed successfully.');

        $this->comment('Publishing Vite config...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-vite', '--force' => true]);

        

        $web_route_file = base_path('routes/web.php');
        $tacms_require_line = 'require __DIR__.\'/tacms.php\';';
        
        $webRoutes = file_get_contents($web_route_file);
        dump($webRoutes);
        if (!Str::contains($webRoutes, $tacms_require_line)) {
            $is_first_run = true;
            file_put_contents($web_route_file, "\r\n" . $tacms_require_line, FILE_APPEND);
        }
        $webRoutes = file_get_contents($web_route_file);
        dump($webRoutes);

        $this->info('TACMS Routes installed successfully.');
        $this->info($is_first_run ? 'first run' : 'not first run');
        if($is_first_run){
            $this->comment('Running migrations...');
            $this->call('migrate');
            $this->info('Database tables created successfully.');
        }
        
        
    }
}