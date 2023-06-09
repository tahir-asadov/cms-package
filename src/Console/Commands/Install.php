<?php

namespace Tahir\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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

        $this->comment('Publishing TACMS Migrations...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-migrations', '--force' => $this->option('force')]);

        $this->comment('Publishing TACMS Routes...');
        $this->callSilent('vendor:publish', ['--tag' => 'tacms-routes', '--force' => $this->option('force')]);

        $this->info('TACMS scaffolding installed successfully.');
        
        $this->comment('Installing TACMS Routes...');

        $web_route_file = base_path('routes/web.php');
        $tacms_require_line = 'require __DIR__.\'/tacms.php\';';
        
        $webRoutes = file_get_contents($web_route_file);
        if (!Str::contains($webRoutes, $tacms_require_line)) {
            $is_first_run = true;
            file_put_contents($web_route_file, "\r\n" . $tacms_require_line, FILE_APPEND);
        }
        $this->info('TACMS Routes installed successfully.');
        
        if($is_first_run){
            $this->comment('Running migrations...');
            $this->callSilently('migrate');
            $this->info('Database tables created successfully.');
        }
    }
}