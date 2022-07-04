<?php


namespace Visanduma\LaravelFormy\Inputs;


use App\Helpers\Forms\Traits\MultiChoice;

class ChecksBox extends BaseInput
{
    use MultiChoice;

    public static function make($label, $name = ""): BaseInput
    {
        return new self($label, $name);
    }

    public function html()
    {
        return view('formy::inputs.checkbox-input', [
            'input' => $this,
            'disabled' => $this->disabled,
            'classes' => implode(" ", $this->classes),
            'options' => $this->options
        ])->render();
    }


}
