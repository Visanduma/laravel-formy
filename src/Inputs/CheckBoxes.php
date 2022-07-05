<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\MultiChoice;

class CheckBoxes extends BaseInput
{
    use MultiChoice;

    public static function make($label, $name = ""): CheckBoxes
    {
        return new self($label, $name);
    }

    public function html()
    {
        $this->setAttribute('type','checkbox');
        return view('formy::inputs.checkbox-input', [
            'input' => $this,
            'options' => $this->options
        ])->render();
    }


}
