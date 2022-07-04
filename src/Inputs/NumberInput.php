<?php

namespace Visanduma\LaravelFormy\Inputs;

class NumberInput extends BaseInput
{
    public bool $showOnUpdate = true;

    public static function make($label, $name = ""): NumberInput
    {
        return new self($label, $name);
    }

    public function html()
    {
        $this->setAttribute('type','number');
        return view('formy::inputs.text-input', [
            'input' => $this,
        ])->render();
    }
}
