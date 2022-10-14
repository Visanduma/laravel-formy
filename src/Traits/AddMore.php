<?php

namespace Visanduma\LaravelFormy\Traits;

use Closure;

trait AddMore {

    public $createCallback;

    public function onCreate(Closure $callback)
    {
        $this->createCallback = $callback;
        $this->setConfig('creatable', true);
        $this->setAttribute('depend', $this->getName());

        return $this;
    }
}
