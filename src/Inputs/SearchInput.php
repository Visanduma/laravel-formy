<?php


namespace Visanduma\LaravelFormy\Inputs;


use Visanduma\LaravelFormy\Traits\HasInertiaInput;


class SearchInput extends BaseInput
{
    use HasInertiaInput;

    public $searchModel,$search_column,$value_column;

    public $results_limit = 3;


    public static function make($label, $name = ""): SearchInput
    {
        return new self($label, $name);
    }

    public function html($theme,$model)
    {

        return $this->inputView('select-input', $theme, [
            // data
        ]);
    }

    public function search($model, $search_column = 'name', $value_column = 'id')
    {
            $this->searchModel = $model;
            $this->search_column = $search_column;
            $this->value_column = $value_column;

            return $this;
    }

    public function getConfigs()
    {
        return [
            'searchUrl' => route('formy.search-model',['input' => $this->getName()]),
        ];
    }


}
