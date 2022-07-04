<?php


namespace Visanduma\LaravelFormy\Inputs;


class TextInput extends BaseInput
{

    public static function make($label, $name = ""): TextInput
    {
        return new self($label, $name);
    }


    public function html()
    {
        $this->setAttribute('type','text');

        return view('formy::inputs.text-input', [
            'input' => $this,
        ])->render();
    }


}
