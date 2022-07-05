<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\MultiChoice;

class RadioInputs extends BaseInput
{
    use MultiChoice;


    public static function make($label, $name = ""): RadioInputs
    {
        return new self($label, $name);
    }

    public function html()
    {
        return view('formy::inputs.radio-input', [
            'input' => $this,
            'disabled' => $this->disabled,
            'options' => $this->options
        ])->render();
    }


}
