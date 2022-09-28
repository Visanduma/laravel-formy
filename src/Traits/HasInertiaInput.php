<?php


namespace Visanduma\LaravelFormy\Traits;


trait HasInertiaInput
{
    public function getVueComponentData()
    {

        $bindings = array_merge($this->attributesArray(),[
            'classString' => "form-control ".$this->classString(),
            'class' => $this->getWrapperClass(),
            'options' => method_exists($this,'getOptions') ? $this->getOptions() : []
        ]);


        return [
            'component' => $this->getComponentName(),
            'binding' => $bindings,
        ];
    }

    protected function getComponentName():string
    {
        return class_basename($this);
    }
}
