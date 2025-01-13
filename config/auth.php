<?php

return [

    /*
    |----------------------------------------------------------------------
    | Authentication Defaults
    |----------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'), // Default guard is 'web', but you can set 'professor' or 'admin' as default
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |----------------------------------------------------------------------
    | Authentication Guards
    |----------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | All authentication guards have a user provider, which defines how the
    | users are retrieved from the database or another storage system.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Custom guard for professors
        'professor' => [
            'driver' => 'session',
            'provider' => 'professors', // Define the professors provider below
        ],

        // Custom guard for admins
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // This references the 'admins' provider we will define below
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are retrieved from your database or other storage systems.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent different models/tables.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // Custom provider for professors
        'professors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Professor::class,  // Use the Professor model here
        ],

        // Custom provider for admins
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, // Make sure you create an Admin model
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Resetting Passwords
    |----------------------------------------------------------------------
    |
    | Configuration options for password reset functionality. Includes
    | the table for token storage and the user provider that is invoked
    | to retrieve users.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        // Add password reset settings for professors (if needed)
        'professors' => [
            'provider' => 'professors',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        // Add password reset settings for admins (if needed)
        'admins' => [
            'provider' => 'admins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Password Confirmation Timeout
    |----------------------------------------------------------------------
    |
    | Defines the amount of time before the password confirmation window expires.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
