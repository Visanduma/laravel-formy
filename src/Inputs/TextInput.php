<?php


namespace Visanduma\LaravelFormy\Inputs;


class TextInput extends BaseInput
{

    public static function make($label, $name = ""): TextInput
    {
        return new self($label, $name);
    }


    public function html($theme)
    {
        $this->setAttribute('type','text');

        return $this->inputView('text-input',$theme);
    }


}
