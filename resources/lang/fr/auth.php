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

    'failed'        => 'Ces informations de connexion ne correspondent pas.',
    'general_error' => "Vous n'avez pas les droits requis pour cette action.",
    'password_rules' => 'Your password must be more than 8 characters long, should contain at least 1 uppercase, 1 lowercase and 1 number.',
    'password_used' => 'Vous ne pouvez pas utiliser un mot de passe que vous avez déjà utilisé',
    'code_expired'          => 'The code provided has expired.',
    'unauthorized_company'  => 'You are not authorized to create a user in this company.',
    'unauthorized_role'     => 'You can only assign a role lower than the :highest_role role to a user',
    'phone_or_email'        => 'Please enter a valid phone number or e-mail address.',
    'unique_phone_or_email' => 'The contact :username provided is linked to a different account',
    'invalid_pin'           => 'The :attribute is invalid. Please enter 4 random digits',
    'not_found_pin'         => 'Warning! You have entered an incorrect pin.',
    'socialite'     => [
        'unacceptable' => 'Le login :provider est de type incorrect.',
    ],
    'throttle' => 'Vous avez effectué trop de tentatives de connexion. Veuillez ré-essayer dans :seconds secondes.',
    'unknown'  => 'Une erreur inconnue est survenue.',
    'cant_change_company_name' => 'You are not allowed to change the company name.',
    'cant_change_company_type' => 'You are not allowed to change the company type.',
];
