<?php


namespace Visanduma\LaravelFormy\Inputs;


class ColorInput extends BaseInput
{

    public static function make($label, $name = ""): ColorInput
    {
        return new self($label, $name);
    }


    public function html($theme)
    {
        $this->setAttribute('type','color');
        $this->addClass('w-25');

        return $this->inputView('text-input', $theme);
    }


}
