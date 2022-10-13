<?php

namespace Visanduma\LaravelFormy\Inputs;

use Closure;

class Depend {


public static function on($inputName, Closure $callback)
{
    return new static($inputName,$callback);
}

public function __construct(private $inputName, public $callback) {}

}
