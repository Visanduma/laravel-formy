<?php


namespace Visanduma\LaravelFormy\Inputs;


class DateInput extends BaseInput
{

    public static function make($label, $name = ""): DateInput
    {
        return new self($label, $name);
    }


    public function html()
    {
        $this->setAttribute('type','date');

        return view('formy::inputs.text-input', [
            'input' => $this,
        ])->render();
    }


}
