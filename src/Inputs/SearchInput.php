<?php


namespace Visanduma\LaravelFormy\Inputs;


use Closure;
use Visanduma\LaravelFormy\Traits\HasInertiaInput;


class SearchInput extends BaseInput
{
    use HasInertiaInput;

    public $searchFunction, $keyColumn, $valueColumn;

    public static function make($label, $name = ""): SearchInput
    {
        $ins = new self($label, $name);
        $ins->setConfig('searchUrl', route('formy.search-model',['input' => $ins->getName()]));
        return $ins;
    }

    public function html($theme,$model)
    {

        return $this->inputView('select-input', $theme, [
            // data
        ]);
    }

    public function query(Closure $closure, $value , $key = 'id')
    {
        $this->keyColumn = $key;
        $this->valueColumn = $value;
        $this->searchFunction = $closure;

        return $this;
    }

}
