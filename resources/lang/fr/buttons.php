<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Buttons Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in buttons throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'activate'           => 'Activer',
                'change_password'    => 'Changer de mot de passe',
                'clear_session'      => 'Effacer la session',
                'confirm'            => 'Confirmer',
                'deactivate'         => 'Désactiver',
                'delete_permanently' => 'Supprimer définitivement',
                'login_as'           => 'Se connecter en tant qu\'utilisateur',
                'resend_email'       => 'Renvoyer le mail de confirmation',
                'restore_user'       => "Réactiver l'utilisateur",
                'transfer_user'      => 'Transférer l\'utilisateur',
                'reset_pin'          => 'Réinitialisation du code Pin',
                'reset_topup_account'          => 'Réinitialisation du compte de recharge',
                'unconfirm'          => 'Infirmer',
                'unlink' => 'Unlink',
            ],
        ],
        'services' => [
            'service' => [
                'activate' => 'Activer le service',
                'deactivate' => 'Désactiver le Service',
            ],
            'method' => [
                'activate' => 'Activer le mode',
                'deactivate' => 'Désactiver le mode',
            ],
            'category' => [
                'activate' => 'Activer la catégorie',
                'deactivate' => 'Désactiver la catégorie',
            ]
        ],
        'companies' => [
            'company' => [
                'activate'   => 'Actciver l\'entreprise',
                'deactivate' => 'Désactiver l\'entreprise',
                'login'      => 'Se connecter à cette entreprise'
            ],
            'services' => [
                'commission' => [
                    'stack' => 'Stack',
                ]
            ]
        ],
        'account' => [
            'credit' => 'Credit',
            'debit' => 'Debit',
            'float' => 'Float',
            'payout' => 'Paiement',
            
            'activate' => 'Débloquer un compte',
            'deactivate' => 'Bloquer un compte'
        ],
        'payout' => [
            'cancel' => 'Annuler',
            'approve' => 'Approuver',
            'reject' => 'Rejetter',
        ]
    ],

    'emails' => [
        'auth' => [
            'confirm_account' => 'Confirmer le compte',
            'reset_password'  => 'Réinitialiser le mot de passe',
        ],
    ],

    'general' => [
        'cancel' => 'Annuler',
        'back'   => 'Retourner',
        'continue' => 'Continuer',
        'submit'   => 'Soumettre',

        'crud' => [
            'create' => 'Créer',
            'delete' => 'Supprimer',
            'edit'   => 'Modifier',
            'update' => 'Mettre à jour',
            'view'   => 'Voir',
        ],

        'save' => 'Sauvegarder',
        'view' => 'Voir',
    ],
];
