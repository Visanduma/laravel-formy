<?php


namespace Visanduma\LaravelFormy\Traits;


use Closure;
use Illuminate\Support\Arr;

trait MultiChoice
{
    protected array $options = [];
    private array $selectedValues = [];

    public function options($values)
    {
        $this->options = $values;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function selected($value)
    {
        $this->selectedValues = Arr::wrap($value);
        return $this;
    }

    public function getSelectedValue(): array
    {
        return $this->selectedValues;
    }

    public function selectedBy($value): bool
    {
        if (empty($this->selectedValues)) {
            $this->selectedValues[] = array_key_first($this->options);
        }

        return in_array($value, $this->selectedValues);
    }

    
}
