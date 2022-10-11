<?php

namespace Visanduma\LaravelFormy\Inputs;

use Visanduma\LaravelFormy\Traits\HasInertiaInput;

class PasswordInput extends TextInput
{

    use HasInertiaInput;

    public static function make($label, $name = ""): PasswordInput
    {
        $ins = new self($label, $name);
        $ins->setAttribute('type','password');

        return $ins;
    }

    protected function getComponentName(): string
    {
        return 'TextInput';
    }


}
