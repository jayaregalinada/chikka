<?php

return [
    'shortcode' => env('CHIKKA_SHORTCODE'),
    'key' => env('CHIKKA_KEY'),
    'secret' => env('CHIKKA_SECRET'),
    'uri' => env('CHIKKA_URI', 'https://post.chikka.com/smsapi/request'),
    'timeout' => env('CHIKKA_TIMEOUT', 180),
];
