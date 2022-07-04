<?php

namespace Visanduma\LaravelFormy\Commands;

use Illuminate\Console\Command;

class LaravelFormyCommand extends Command
{
    public $signature = 'laravel-formy';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
