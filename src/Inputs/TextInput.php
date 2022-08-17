<?php


namespace Visanduma\LaravelFormy\Inputs;


class TextInput extends BaseInput
{

    public static function make($label, $name = ""): TextInput
    {
        $ins = new self($label, $name);
        $ins->setAttribute('type','text');

        return $ins;
    }


    public function html($theme)
    {
        return $this->inputView('text-input',$theme);
    }

    public function type($inputType)
    {
        $this->setAttribute('type',$inputType);
        return $this;
    }


}
