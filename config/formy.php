<?php
// config for Visanduma/LaravelFormy

return [

    /*
    |--------------------------------------------------------------------------
    | Apply any middlware to formy realated routes
    |--------------------------------------------------------------------------
    |
    */

    'middlewares' => [
        'web'
    ],


    /*
    |--------------------------------------------------------------------------
    | Formy media managemt setup
    |--------------------------------------------------------------------------
    |
    */

    'media' => [

        // Disk to store file uploded by formy
        'disk' => 'public',

        // File upload path
        'upload_path' => 'formy-media',

        // Tempory file path
        'temp_path' => 'formy/temp-uploads',

        // Media handler class
        'handler' => \Visanduma\LaravelFormy\Handlers\FormyMediaHandler::class

    ]

];
