<?php


namespace Visanduma\LaravelFormy\Inputs;


class FileInput extends BaseInput
{

    public static function make($label, $name = ""): FileInput
    {
        return new self($label, $name);
    }


    public function html()
    {
        $this->setAttribute('type','file');

        return view('formy::inputs.text-input', [
            'input' => $this,
        ])->render();
    }


}
