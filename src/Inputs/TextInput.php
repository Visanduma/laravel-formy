<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\HasInertiaInput;

class TextInput extends BaseInput
{
    use HasInertiaInput;

    public static function make($label, $name = ""): TextInput
    {
        $ins = new self($label, $name);
        $ins->type('text');

        return $ins;
    }


    public function html($theme)
    {
        return $this->inputView('text-input',$theme);
    }

    public function type($inputType)
    {
        $this->setAttribute('type',$inputType);
        return $this;
    }

    public function autoCompleteOff()
    {
        $this->setAttribute('autocomplete','off');
        return $this;
    }


}
