<?php


namespace Visanduma\LaravelFormy\Inputs;


class FileInput extends BaseInput
{

    public static function make($label, $name = ""): FileInput
    {
        return new self($label, $name);
    }


    public function html($theme)
    {
        $this->setAttribute('type','file');

        return $this->inputView('text-input',$theme);
    }


}
