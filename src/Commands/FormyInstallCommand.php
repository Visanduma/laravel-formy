<?php

namespace Visanduma\LaravelFormy\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Visanduma\LaravelFormy\Traits\StubHelper;

class FormyInstallCommand extends Command
{
    use StubHelper;

    public $signature = 'formy:install';

    public $description = 'Install laravel formy & copy required assets';

    public function handle()
    {
        $this->comment('Installing Formy assets');

        if (File::deleteDirectory(public_path('vendor/formy'))) {
            $this->comment('Cleaning Existing assets ...');
        }

        $this->callSilent('vendor:publish', [ '--tag' => 'formy-assets']);

        $this->info('Formy assets installed !');
    }
}
