<?php


namespace Visanduma\LaravelFormy\Inputs;


class RangeInput extends BaseInput
{

    public static function make($label, $name = ""): RangeInput
    {
        return new self($label, $name);
    }


    public function html($theme)
    {
        $this->setAttribute('type','range');

        return $this->inputView('text-input', $theme);
    }


}
