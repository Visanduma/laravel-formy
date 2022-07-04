<?php


namespace Visanduma\LaravelFormy\Inputs;


use App\Helpers\Forms\Traits\MultiChoice;

class RadioButtons extends BaseInput
{
    use MultiChoice;


    public static function make($label, $name = ""): RadioButtons
    {
        return new self($label, $name);
    }

    public function html()
    {
        return view('formy::inputs.radio-input', [
            'input' => $this,
            'disabled' => $this->disabled,
            'classes' => implode(" ", $this->classes),
            'options' => $this->options
        ])->render();
    }


}
