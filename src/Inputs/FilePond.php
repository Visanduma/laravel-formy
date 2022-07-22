<?php


namespace Visanduma\LaravelFormy\Inputs;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Visanduma\LaravelFormy\Controllers\FilePondController;

class FilePond extends BaseInput
{
    private $options = [];
    private $uploadedKeys = [];

    public static function make($label, $name = ""): FilePond
    {
        $ins = new static($label, $name);
        $ins->setAttribute('type','file');
        $ins->setOption('server', route('formy.file-upload'));
        $ins->setOption('credits',false);

        return $ins;
    }


    public function html($theme)
    {
        return $this->inputView('filepond-input',$theme);
    }

    public function options()
    {
        return $this->options;
    }

    public function setOption($name,$value)
    {
        $this->options[$name] = $value;
    }

    public function disable()
    {
        $this->setOption('disabled',true);
        return $this;
    }

    public function multiple()
    {
        $this->setOption('allowMultiple',true);
        $this->setOption('name',$this->getAttribute('name')."[]");
//        $this->removeAttribute('name');

        return $this;
    }


    public static function moveFilesTo($inputName,$destination)
    {
        $files = request()->get($inputName);
        $output = [];

        foreach (Arr::wrap($files) as $file){
            $source = FilePondController::ROOT_DIR."/$file";
            $destination = Str::finish($destination,"/$file");

            Storage::move($source, $destination);

            $output[] = $destination;
        }

        request()->merge([
            $inputName => empty($output) ? null : $output
        ]);

        return $output;
    }



}
