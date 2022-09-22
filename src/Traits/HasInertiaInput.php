<?php


namespace Visanduma\LaravelFormy\Traits;


trait HasInertiaInput
{
    public function getVueComponentData()
    {
        $bindings = array_merge($this->attributesArray(),[
            'classString' => "form-control ".$this->classString(),
            'options' => method_exists($this,'getOptions') ? $this->getOptions() : []
        ]);


        return [
            'component' => class_basename($this),
            'binding' => $bindings,
        ];
    }
}
