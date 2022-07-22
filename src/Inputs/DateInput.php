<?php


namespace Visanduma\LaravelFormy\Inputs;


class DateInput extends BaseInput
{

    public static function make($label, $name = ""): DateInput
    {
        return new self($label, $name);
    }


    public function html($theme)
    {
        $this->setAttribute('type','date');

        return $this->inputView('text-input', $theme);
    }


}
