<?php


namespace Visanduma\LaravelFormy\Traits;

use Illuminate\Support\Pluralizer;

trait StubHelper
{
    public function getStubPath()
    {
        return __DIR__ . './../../resources/stubs/Form.php.stub';
    }

    public function getStubVariables()
    {
        return [
            'NAMESPACE'         => 'App\\Forms',
            'CLASS_NAME'        => $this->getSingularClassName($this->argument('name')),
        ];
    }

    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('$'.$search.'$' , $replace, $contents);
        }

        return $contents;

    }

    public function getSourceFilePath()
    {
        return app_path('Forms') .'/' .$this->getSingularClassName($this->argument('name')) . '.php';
    }

    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}
