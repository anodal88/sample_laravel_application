<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'paypal' => [
        'client_id' => 'AWktiIbuJ_szhlxJeDp253-EwLDrpu6Vs94qgauH4N8AUwq8-CjsvRsNyGyvaY6emrVM16NobfnnIVio',
        'secret' => 'EL1R7tQsxsCrttE0_vqsd26zeIcjQqieKJT8_Pu8WEL1NWVy_zoB1CxBmjS7l68g7uIJZ5O4y5GxImY_'
    ],
];
