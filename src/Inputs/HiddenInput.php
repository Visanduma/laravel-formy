<?php

namespace Visanduma\LaravelFormy\Inputs;

use Visanduma\LaravelFormy\Traits\HasInertiaInput;


class HiddenInput extends BaseInput
{
    use HasInertiaInput;

    public bool $showOnUpdate = true;

    public static function make($label, $name = ""): HiddenInput
    {
        $el = new self($label, $name);
        $el->setAttribute('type','hidden');
        $el->addWrapperClass('d-none');

        return $el;
    }

    public function html($theme)
    {
        return $this->inputView('text-input',$theme);
    }

    protected function getComponentName():string
    {
        return "TextInput";
    }

}
