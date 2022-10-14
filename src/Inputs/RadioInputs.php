<?php

namespace Visanduma\LaravelFormy\Inputs;

use Closure;
use Visanduma\LaravelFormy\Traits\AddMore;
use Visanduma\LaravelFormy\Traits\HasDependence;
use Visanduma\LaravelFormy\Traits\HasInertiaInput;
use Visanduma\LaravelFormy\Traits\MultiChoice;

class RadioInputs extends BaseInput
{
    use MultiChoice;
    use HasInertiaInput;
    use HasDependence;
    use AddMore;


    public static function make($label, $name = ""): RadioInputs
    {
        return new self($label, $name);
    }

    public function html($theme)
    {
        return $this->inputView('radio-input', $theme, [
            'disabled' => $this->disabled,
            'options' => $this->options,
        ]);
    }


}
