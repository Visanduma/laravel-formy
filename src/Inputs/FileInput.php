<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\HasInertiaInput;

class FileInput extends BaseInput
{
    use HasInertiaInput;

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
