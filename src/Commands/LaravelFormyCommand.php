<?php

namespace Visanduma\LaravelFormy\Commands;

use Illuminate\Console\Command;
use Visanduma\LaravelFormy\Traits\StubHelper;
use Illuminate\Filesystem\Filesystem;

class LaravelFormyCommand extends Command
{

    use StubHelper;

    public $signature = 'make:form {name}';

    public $description = 'Make new Formy class';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $path = $this->getSourceFilePath();
        $this->makeDirectory(dirname($path));
        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("Form : {$path} created");
        } else {
            $this->warn("Form : {$path} already exits");
        }
    }


}
