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


    public function html()
    {
        return view('formy::inputs.textarea-input', [
            'input' => $this,
            'disabled' => $this->disabled,
            'classes' => implode(" ", $this->classes)
        ])->render();
    }


}
