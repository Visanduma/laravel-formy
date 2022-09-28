<?php

namespace Visanduma\LaravelFormy\Inputs;

use Visanduma\LaravelFormy\Traits\HasInertiaInput;


class NumberInput extends BaseInput
{
    use HasInertiaInput;


    public bool $showOnUpdate = true;

    public static function make($label, $name = ""): NumberInput
    {
        $el = new self($label, $name);
        $el->setAttribute('type','number');
        return $el;
    }

    public function html($theme)
    {
        return $this->inputView('text-input',$theme);
    }

     protected function getComponentName():string
    {
        return "TextInput";
    }
}
