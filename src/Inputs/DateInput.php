<?php

namespace Visanduma\LaravelFormy\Inputs;

use Visanduma\LaravelFormy\Traits\HasInertiaInput;

class DateInput extends BaseInput
{
    use HasInertiaInput;

    public static function make($label, $name = ""): DateInput
    {
        $ins = new self($label, $name);

        $ins->setAttribute('type', 'date');

        return $ins;
    }

    public function html($theme)
    {
        return $this->inputView('text-input', $theme);
    }

     protected function getComponentName(): string
     {
         return "TextInput";
     }
}
