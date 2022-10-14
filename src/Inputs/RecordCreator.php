<?php


namespace Visanduma\LaravelFormy\Inputs;


use Closure;
use Visanduma\LaravelFormy\Traits\HasInertiaInput;

class RecordCreator extends BaseInput
{
    use HasInertiaInput;

    public $createCallback;

    public static function make($label, $name = ""): RecordCreator
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

    public function onCreate(Closure $callback)
    {
        $this->createCallback = $callback;
        return $this;
    }


}
