<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'                => 'These credentials do not match our records.',
    'general_error'         => 'You do not have access to do that.',
    'password_rules'        => 'Your password must be more than 8 characters long, should contain at least 1 uppercase, 1 lowercase and 1 number.',
    'password_used'         => 'You can not set a password that you have previously used.',
    'code_expired'          => 'The code provided has expired.',
    'unauthorized_company'  => 'You are not authorized to create a user in this company.',
    'unauthorized_role'     => 'You can only assign a role lower than the :highest_role role to a user',
    'phone_or_email'        => 'Please enter a valid phone number or e-mail address.',
    'unique_phone_or_email' => 'The contact :username provided is linked to a different account',
    'socialite'             => [
        'unacceptable' => ':provider is not an acceptable login type.',
    ],
    'throttle'              => 'Too many login attempts. Please try again in :seconds seconds.',
    'unknown'               => 'An unknown error occurred',
];
