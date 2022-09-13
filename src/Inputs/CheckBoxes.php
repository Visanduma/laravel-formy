<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\HasInertiaInput;
use Visanduma\LaravelFormy\Traits\MultiChoice;

class CheckBoxes extends BaseInput
{
    use MultiChoice, HasInertiaInput;

    public static function make($label, $name = ""): CheckBoxes
    {
        return new self($label, $name);
    }

    public function html($theme)
    {
        $this->setAttribute('type','checkbox');
        $this->setAttribute('name',$this->getAttribute('name')."[]");

        return $this->inputView('checkbox-input',$theme, [
            'options' => $this->options
        ]);
    }


}
