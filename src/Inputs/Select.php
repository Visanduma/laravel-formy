<?php


namespace Visanduma\LaravelFormy\Inputs;


use Modules\Blog\Entities\BlogPost;
use Visanduma\LaravelFormy\Traits\HasRelationship;
use Visanduma\LaravelFormy\Traits\MultiChoice;

class Select extends BaseInput
{
    use MultiChoice, HasRelationship;


    public static function make($label, $name = ""): Select
    {
        return new self($label, $name);
    }

    public function html($theme,$model)
    {
        $this->getRelationData($model);

        return $this->inputView('select-input', $theme, [
            'options' => $this->options
        ]);
    }


}
