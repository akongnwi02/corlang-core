<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'Rôle créé avec succès.',
            'deleted' => 'Rôle supprimé avec succès.',
            'updated' => 'Rôle mis à jour avec succès.',
        ],

        'users' => [
            'cant_resend_confirmation' => "L'application est actuellement paramétrée avec une validation manuelle des utilisateurs.",
            'confirmation_message'  => "Un message de confirmation a été adressé à l'adresse indiquée.",
            'confirmed'              => "Le compte de l'utilisateur a été confirmé avec succès.",
            'created'             => 'Utilisateur créé avec succès.',
            'deleted'             => 'Utilisateur supprimé avec succès.',
            'deleted_permanently' => "L'utilisateur a été supprimé définitivement.",
            'restored'            => "L'utilisateur a été ré-activé.",
            'session_cleared'      => "La session de l'utilisateur a été effacé avec succès.",
            'social_deleted' => 'Le compte de réseau social a été effacé avec succès.',
            'unconfirmed' => "Le compte de l'utilisateur a été infirmé avec succès.",
            'updated'             => 'Utilisateur mis à jour avec succès.',
            'transferred'                 => 'The user was successfully transferred.',
            'updated_password'    => 'Le mot de passe utilisateur a été mis à jour avec succès.',
            'reset_pin'         => "The user's pin was successfully reset.",
            'reset_topup_account'         => "The user's top up accounts were successfully reset.",
        ],
        
        'companies' => [
            'company' => [
                'created' => 'The company was successfully created.',
                'updated' => 'The company was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
                'logged_in'     => 'You have changed company successfully.',
            ],
            'service' => [
                'status_updated' => 'The status was successfully updated.',
                'updated' => 'The service was updated for this company successfully.',
            ]
        ],
        'services' => [
            'service' => [
                'created' => 'The service was successfully created.',
                'updated' => 'The service was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
            ],
            'category' => [
                'created' => 'The category was successfully created.',
                'updated' => 'The category was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
            ],
            'commission' => [
                'created' => 'The service charge was updated successfully.',
            ],
            'method' => [
                'created' => 'The payment method was successfully created.',
                'updated' => 'The payment method was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
            ]
        ],
        'accounting' => [
            'collection' => [
                'paid' => 'The collection was paid successfully.'
            ],
            'provision' => [
                'requested' => 'The provision was requested successfully.',
            ]
        ],
        'account' => [
            'floated' => 'Float applied successfully.',
            'transferred' => 'Amount transferred successfully,',
            'status_updated' => 'The status was successfully updated.',
            'drained' => 'Amount drained successfully.',
            'paid_out' => 'The payout request was successful. The request is pending validation.',
        ],
        'payout' => [
            'status_updated' => 'Payout status updated successfully.'
        ]
    ],

    'frontend' => [
        'contact' => [
            'sent' => "Votre message a été envoyé avec succès. Nous répondrons à l'adresse email que vous nous avez fourni dès que nous le pourrons.",
        ],
    ],
    'api'      => [
        'users' => [
            'logged_out' => 'User logged out successfully.'
        ]
    ]
];
