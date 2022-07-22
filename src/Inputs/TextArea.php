<?php


namespace Visanduma\LaravelFormy\Inputs;


class TextArea extends BaseInput
{

    public static function make($label, $name = ""): TextArea
    {
        return new self($label, $name);
    }

    public function columns($value)
    {
        $this->setAttribute('cols', $value);
        return $this;
    }

    public function rows($value)
    {
        $this->setAttribute('rows', $value);
        return $this;
    }


    public function html($theme)
    {
        return $this->inputView('textarea-input', $theme,[
            'disabled' => $this->disabled
        ]);
    }


}
