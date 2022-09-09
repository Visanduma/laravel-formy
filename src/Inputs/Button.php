<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\HasRelationship;
use Visanduma\LaravelFormy\Traits\MultiChoice;

class Button extends BaseInput
{

    public static function make($label, $name = ""): Button
    {
        $input = new self($label, $name);
        $input->removeAttribute('v-model');

        return $input;
    }

    public function html($theme)
    {
        return $this->inputView('form-button', $theme);
    }


}
