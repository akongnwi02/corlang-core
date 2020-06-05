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
                'login_as'           => 'Se connecter an tant que :user',
                'resend_email'       => 'Renvoyer le mail de confirmation',
                'restore_user'       => "Réactiver l'utilisateur",
                'transfer_user'      => 'Transfer User',
                'reset_pin'          => 'Reset Pin Code',
                'reset_topup_account'          => 'Reset Top up Account',
                'unconfirm'          => 'Infirmer',
                'unlink' => 'Unlink',
            ],
        ],
        'services' => [
            'service' => [
                'activate' => 'Activate Service',
                'deactivate' => 'Deactivate Service',
            ],
            'method' => [
                'activate' => 'Activate Method',
                'deactivate' => 'Deactivate Method',
            ],
            'category' => [
                'activate' => 'Activate Category',
                'deactivate' => 'Deactivate Category',
            ]
        ],
        'companies' => [
            'company' => [
                'activate'   => 'Activate Company',
                'deactivate' => 'Deactivate Company',
                'login'      => 'Login to this company'
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
            'payout' => 'Payout',
            
            'activate' => 'Unfreeze Account',
            'deactivate' => 'Freeze Account'
        ],
        'payout' => [
            'cancel' => 'Cancel',
            'approve' => 'Approve',
            'reject' => 'Reject',
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
        'back'   => 'Back',
        'continue' => 'Continuer',
        'submit'   => 'Submit',

        'crud' => [
            'create' => 'Créer',
            'delete' => 'Supprimer',
            'edit'   => 'Editer',
            'update' => 'Mettre à jour',
            'view'   => 'Voir',
        ],

        'save' => 'Sauvegarder',
        'view' => 'Voir',
    ],
];
