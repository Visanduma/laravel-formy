<?php

namespace Visanduma\LaravelFormy\Models;

use Illuminate\Database\Eloquent\Model;

class FormyMedia extends Model
{
    protected $table = 'laravel_formy_media';
    protected $guarded = [];


    public function owner()
    {
        return $this->morphTo('owner');
    }

}
