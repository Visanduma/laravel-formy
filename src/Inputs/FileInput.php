<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\HasInertiaInput;

class FileInput extends BaseInput
{
    use HasInertiaInput;

    private $savedImages = [];


    public static function make($label, $name = ""): FileInput
    {
        $ins = new self($label, $name);
        $ins->setAttribute('type','file');


        return $ins;
    }


    public function addFiles(array $files)
    {
        $this->savedImages = $files;
        return $this;
    }

    public function getSavedImages()
    {
            return $this->savedImages;
    }

    public function html($theme)
    {

        return $this->inputView('text-input',$theme);
    }


}
