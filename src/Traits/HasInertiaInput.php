<?php

namespace Visanduma\LaravelFormy\Traits;

use Visanduma\LaravelFormy\Form;
use Visanduma\LaravelFormy\Handlers\FormyMediaHandler;

trait HasInertiaInput
{
    private $configs = [];

    public function getVueComponentData(Form $form = null)
    {
        $mediaHandler = new FormyMediaHandler();

        $bindings = array_merge($this->attributesArray(), [
            'classString' => "form-control ".$this->classString(),
            'wrapperClassString' => 'mb-3',
            'class' => $this->getWrapperClass(),
            'options' => method_exists($this, 'getOptions') ? $this->getOptions() : [],
            'files' => method_exists($this, 'getSavedImages') ? $form?->getModel()?->mediaArray() : [],
            'configs' => $this->getConfigs(),
            'value' => $this->getValue(),

        ]);

        return [
            'component' => $this->getComponentName(),
            'binding' => $bindings,
        ];
    }

    protected function getComponentName(): string
    {
        return class_basename($this);
    }

    public function setConfig($name, $value)
    {
        $this->configs[$name] = $value;

        return $this;
    }

    public function getConfig($name, $default = null)
    {
        return $this->configs[$name] ?? $default ;
    }

    protected function getConfigs(): array
    {
        return $this->configs;
    }
}
