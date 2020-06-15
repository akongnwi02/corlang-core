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
            'confirmed'              => "L'utilisateur a été confirmé avec succès.",
            'created'             => 'Utilisateur créé avec succès.',
            'deleted'             => 'Utilisateur supprimé avec succès.',
            'deleted_permanently' => "L'utilisateur a été supprimé définitivement.",
            'restored'            => "L'utilisateur a été réactivé.",
            'session_cleared'      => "La session de l'utilisateur a été effacée avec succès.",
            'social_deleted' => 'Le compte de réseau social a été effacé avec succès.',
            'unconfirmed' => "Le compte de l'utilisateur a été infirmé avec succès.",
            'updated'             => 'Utilisateur mis à jour avec succès.',
            'transferred'                 => "L'utilisateur a été transféré avec succès.",
            'updated_password'    => 'Le mot de passe de l\'utilisateur a été mis à jour avec succès.',
            'reset_pin'         => "Le code d'accès de l'utilisateur a été réinitialisé avec succès.",
            'reset_topup_account'         => "Les comptes de recharge de l'utilisateur ont été réinitialisés avec succès.",
        ],
        
        'companies' => [
            'company' => [
                'created' => 'L\'entreprise a été créée avec succès.',
                'updated' => 'L\'entreprise a été mise à jour avec succès.',
                'status_updated' => 'Le statut a été mis à jour avec succès.',
                'logged_in'     => 'Vous avez changé d\'entreprise avec succès.',
            ],
            'service' => [
                'status_updated' => 'Le statut a été mis à jour avec succès.',
                'updated' => 'Le service a été mis à jour pour cette entreprise avec succès.',
            ]
        ],
        'services' => [
            'service' => [
                'created' => 'Le service a été crée avcec succès.',
                'updated' => 'Le service a été mis à jour avec succès.',
                'status_updated' => 'Le statut a été mis à jour avec succès.',
            ],
            'category' => [
                'created' => 'La rubrique a été crée avce succès.',
                'updated' => 'La rubrique a été mis à jour avce succès.',
                'status_updated' => 'Le statut a été mis à jour avce succès.',
            ],
            'commission' => [
                'created' => 'Les frais de service ont été mis à jour avec succès.',
            ],
            'method' => [
                'created' => 'Le mode de paiement a été créé avec succès.',
                'updated' => 'Le mode de paiement a été mis à jour avec succès.',
                'status_updated' => 'Le statut a été mis à jour avec succès.',
            ]
        ],
        'accounting' => [
            'collection' => [
                'paid' => 'La collecte a été effectuée avec succès.'
            ],
            'provision' => [
                'requested' => 'La provision a été demandée avec succès.',
            ]
        ],
        'account' => [
            'floated' => 'La Float a été appliquée avec succès.',
            'transferred' => 'Montant transféré avec succès,',
            'status_updated' => 'Le statut a été mis à jour avec succès.',
            'drained' => 'Montant extrait avec succès.',
            'paid_out' => 'La demande de paiement a été acceptée. La demande est en attente de validation.',
        ],
        'payout' => [
            'status_updated' => 'Le statut de paiement a été mis à jour avec succès.'
        ]
    ],

    'frontend' => [
        'contact' => [
            'sent' => "Vos informations ont été envoyées avec succès. Nous répondrons à l'e-mail indiqué dans les plus brefs délais.",
        ],
    ],
    'api'      => [
        'users' => [
            'logged_out' => 'Utilisateur déconnecté avec succès.'
        ]
    ]
];
