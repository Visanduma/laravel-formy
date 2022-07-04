<?php

namespace Visanduma\LaravelFormy\Inputs;

class PasswordInput extends BaseInput
{
    public bool $showOnUpdate = false;

    public static function make($label, $name = ""): PasswordInput
    {
        return new self($label, $name);
    }

    public function html()
    {
        $this->setAttribute('type','password');
        return view('formy::inputs.text-input', [
            'input' => $this,
        ])->render();
    }
}
