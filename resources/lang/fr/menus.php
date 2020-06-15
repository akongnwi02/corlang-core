<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Gestion des accès',

            'roles' => [
                'all'        => 'Tous les rôles',
                'create'     => 'Créer un rôle',
                'edit'       => 'Modifier un rôle',
                'management' => 'Gestion des rôles',
                'main'       => 'Rôles',
            ],

            'users' => [
                'all'             => 'Tous les utilisateurs',
                'change-password' => 'Changer le mot de passe',
                'transfer-user'   => 'Transférer l\'utilisateur',
                'create'          => 'Créer un utilisateur',
                'deactivated'     => 'Utilisateurs désactivés',
                'deleted'         => 'Utilisateurs supprimés',
                'edit'            => 'Modifier un utilisateur',
                'main'            => 'Utilisateurs',
                'view'            => 'Voir un utilisateur',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Vue du journal',
            'dashboard' => 'Tableau de bord',
            'logs'      => 'Journaux',
        ],

        'sidebar' => [
            'dashboard' => 'Tableau de bord',
            'sales' => 'Ventes',
            'horizon' => 'Horizon',
            'general'   => 'Général',
            'history'   => 'Historique',
            'system'    => 'Système',
            'business'  => 'Activités',
            'access'    => 'Accès',
        ],
        'companies' => [
            'title' => 'Entreprises',
    
            'company' => [
                'management' => 'Entreprises',
                'create'     => 'Créer une entreprise',
                'edit'       => 'Modifier l\'enttreprise',
            ],
        ],

        'services' => [
            'title' => 'Services',
    
            'service'   => [
                'management' => 'Services',
                'create'     => 'Créer un service',
                'edit'       => 'Modifier le service',
            ],
            'category' => [
                'management' => 'Catégories',
                'edit' => 'Modifier la catégorie',
            ],
            'commission' => [
                'management' => 'Frais de service',
                'create'     => 'Créer frais de service',
                'edit'       => 'Modifier frais de service',
            ],
            'method' => [
                'management' => 'Modes de paiement',
                'create'     => 'Créer un mode de paiement',
                'edit'       => 'Modifier le mode de paiement',
            ]
        ],
        'sales' => [
            'management' => 'Ventes',
        ],
        'accounts' => [
            'title' => 'Comptes',
            
            'deposit' => [
                'management' => 'Compte de dépôt',
                'view' => 'Voir le compte'
            ],
            'umbrella' => [
                'management' => 'Compte espèces',
                'view' => 'Voir le compte',
            ],
            'payout' => [
                'management' => 'Compte de commission',
                'view' => 'Voir le compte',
            ]
        ],
        'accounting' => [
            'title' => 'Comptabilité',
            'collections' => [
                'management' => 'Collectes',
                'view' => 'Voir la collecte'
            ],
            'provisions' => [
                'management' => 'Provisions',
                'view' => 'Voir Provisions',
            ],
        ]
    ],

    'language-picker' => [
        'language' => 'Langue',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'العربية (Arabic)',
            'zh'    => 'Chinois simplifié (Chinese Simplified)',
            'zh-TW' => 'Chinois traditionnel (Chinese Traditional)',
            'da'    => 'Danois (Danish)',
            'de'    => 'Allemand (German)',
            'el'    => 'Grec (Greek)',
            'en'    => 'Anglais (English)',
            'es'    => 'Espagnol (Spanish)',
            'fa'    => 'Persan (Persian)',
            'fr'    => 'Français (French)',
            'he'    => 'Hébreu (Hebrew)',
            'id'    => 'Indonésien (Indonesian)',
            'it'    => 'Italien (Italian)',
            'ja'    => 'Japonais (Japanese)',
            'nl'    => 'Hollandais (Dutch)',
            'no'    => 'Norvégien (Norwegian)',
            'pt_BR' => 'Portugais (Brazilian Portuguese)',
            'ru'    => 'Russe (Russian)',
            'sv'    => 'Suédois (Swedish)',
            'th'    => 'Thaïlandais (Thai)',
            'tr'    => 'Turc (Turkish)',
        ],
    ],
];
