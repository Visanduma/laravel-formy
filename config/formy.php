<?php
// config for Visanduma/LaravelFormy

return [

    'middlewares' => [
        'web'
    ],

    'media' => [

        'disk' => 'local',

        'upload_path' => 'formy-media',

        'temp_path' => 'formy/temp-uploads',

        'handler' => \Visanduma\LaravelFormy\Handlers\FormyMediaHandler::class

    ]

];
