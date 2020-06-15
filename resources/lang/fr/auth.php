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
    'password_rules' => 'Votre mot de passe doit contenir un minimum de 8 caractères, dont au moins 1 majuscule, 1 minuscule et 1 chiffre.',
    'password_used' => 'Vous ne pouvez pas utiliser un mot de passe déjà utilisé',
    'code_expired'          => 'Le code fourni a expiré.',
    'unauthorized_company'  => 'Vous n\'êtes pas autorisé à créer un utilisateur dans cette compagnie.',
    'unauthorized_role'     => 'Vous ne pouvez attribuer à un utilisateur qu\'un rôle inférieur au rôle :highest_role',
    'phone_or_email'        => 'Veuillez entrer un numéro de téléphone ou une adresse e-mail valide.',
    'unique_phone_or_email' => 'Le contact :username est lié à un autre compte',
    'invalid_pin'           => 'La valeur de l\'attribut :n\'est pas valide. Veuillez entrer 4 chiffres au hasard',
    'not_found_pin'         => 'Attention ! Vous avez saisi un code pin incorrect.',
    'socialite'     => [
        'unacceptable' => 'Le login :provider de connexion n\'est pas autorisé.',
    ],
    'throttle' => 'Vous avez effectué trop de tentatives de connexion. Veuillez réessayer dans quelques secondes .',
    'unknown'  => 'Une erreur inconnue est survenue.',
    'cant_change_company_name' => 'Vous n\'êtes pas autorisé à changer le nom de l\'entreprise.',
    'cant_change_company_type' => 'Vous n\'êtes pas autorisé à changer le type d\'entreprise.',
];
