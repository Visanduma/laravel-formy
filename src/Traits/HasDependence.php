<?php

namespace Visanduma\LaravelFormy\Traits;

use Closure;
use Illuminate\Support\Str;

trait HasDependence
{
    public $dependencyCallback;

    public function dependOn($inputName, Closure $callback)
    {
        $this->setAttribute('depend', Str::snake($inputName));

        $this->dependencyCallback = $callback;

        return $this;
    }
}
