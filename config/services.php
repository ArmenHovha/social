<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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
    
    'facebook' => [
        'client_id' => '136654933507044',
        'client_secret' => '81f4faf7c436c17db99d4d6e0279de92',
        'redirect' => 'http://fb.am/auth/facebook/callback',
    ],

     'twitter' => [
        'client_id' => 'MjXh12xHKACMZd9zX5tMN7J7s',
        'client_secret' => 'AXDucfQBL6zD8rEsHvVa4yD1hQli0yEt0GmB8twdldw3xFkPUT',
        'redirect' => 'http://fb.am/auth/twitter/callback',
    ],
    
    'google' => [
        'client_id' => '453576134472-ri44lc651mgeldiacl1kp9m77klths3e.apps.googleusercontent.com',
        'client_secret' => '8uJfVBPhBgv5cxx1dPwdqB3o',
        'redirect' => 'http://fb.am/auth/google/callback',
    ],
];
