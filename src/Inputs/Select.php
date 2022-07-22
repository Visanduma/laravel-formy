<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\MultiChoice;

class Select extends BaseInput
{
    use MultiChoice;

    public static function make($label, $name = ""): Select
    {
        return new self($label, $name);
    }


    public function html($theme)
    {
        return $this->inputView('select-input', $theme, [
            'options' => $this->options
        ]);
    }


}
