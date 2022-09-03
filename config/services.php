<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '878745463956-ppt9ul79btg7argidk650ucu2sb60f8a.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/callback/google',
    ],

    'github' => [
        'client_id' => '67106201b384eeb63574',
        'client_secret' => '9525060af5c47f1052ce0fbc7f2ec845ce5f3cb8',
        'redirect' => 'http://localhost:8000/auth/callback/github',
    ],

];
