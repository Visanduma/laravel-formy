<?php

namespace Visanduma\LaravelFormy\Inputs;

class NumberInput extends BaseInput
{
    public bool $showOnUpdate = true;

    public static function make($label, $name = ""): NumberInput
    {
        return new self($label, $name);
    }

    public function html($theme)
    {
        $this->setAttribute('type','number');
        return $this->inputView('text-input',$theme);
    }
}
