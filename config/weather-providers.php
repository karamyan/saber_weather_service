<?php

return [

    'weatherbit' => [
        'api_url'       => env('WEATHERBIT_API_URL', 'https://api.weatherbit.io/v2.0/current'),
        'api_key'   => env('WEATHERBIT_API_KEY', 'fbde667d188b499f8d7a8854fb9d3ac3')
    ],

    'goweather' => [
        'api_url'       => env('GOWEATHER_API_URL', 'https://goweather.herokuapp.com/weather'),
    ]

];
