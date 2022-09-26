<?php

namespace Visanduma\LaravelFormy\Inputs;

class PasswordInput extends TextInput
{
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
