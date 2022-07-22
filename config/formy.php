<?php
// config for Visanduma/LaravelFormy
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

return [

    'middlewares' => [
        'web', InitializeTenancyByDomain::class
    ]

];
