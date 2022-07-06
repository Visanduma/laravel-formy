<?php


namespace Visanduma\LaravelFormy\Inputs;


class RangeInput extends BaseInput
{

    public static function make($label, $name = ""): RangeInput
    {
        return new self($label, $name);
    }


    public function html()
    {
        $this->setAttribute('type','range');

        return view('formy::inputs.text-input', [
            'input' => $this,
        ])->render();
    }


}
