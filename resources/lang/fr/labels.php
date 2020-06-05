<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */
    
    'general' => [
        'all'     => 'Tout',
        'yes'     => 'Oui',
        'no'      => 'Non',
        'copyright'          => 'Copyright',
        'custom'  => 'Personnalisé',
        'actions' => 'Actions',
        'active'  => 'Active',
        'toggle'             => 'Toggle',
        'buttons' => [
            'save'   => 'Enregistrer',
            'update' => 'Mettre à jour',
            'create' => 'Create',
        ],
        'hide'              => 'Cacher',
        'inactive'          => 'Inactive',
        'none'              => 'Aucun',
        'show'              => 'Voir',
        'toggle_navigation' => 'Navigation',
        'create_new'         => 'Create New',
        'add'                => 'Add',
        'remove'             => 'Remove',
        'credit'             => 'Credit',
        'debit'              => 'Debit',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more'               => 'More',
        'select'             => 'Select One'
    ],
    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Créer un rôle',
                'edit'       => 'Editer un rôle',
                'management' => 'Gestion des rôles',
                'table' => [
                    'number_of_users' => "Nombre d'utilisateurs",
                    'permissions'     => 'Permissions',
                    'role'            => 'Rôle',
                    'sort'            => 'Ordre',
                    'total'           => 'rôle total|rôles total',
                ],
            ],
            'users' => [
                'active'              => 'Utilisateurs actifs',
                'all_permissions'     => 'Toutes les permissions',
                'change_password'     => 'Modifier le mot de passe',
                'change_password_for' => 'Modifier le mot de passe pour :user',
                'transfer_user'       => 'Transfer :user to a new Company.',
                'create'              => 'Créer un utilisateur',
                'transfer'            => 'Transfer User',
                'deactivated'         => 'Utilisateurs désactivés',
                'deleted'             => 'Utilisateurs supprimés',
                'edit'                => 'Éditer un utilisateur',
                'management'          => 'Gestion des utilisateurs',
                'no_permissions'      => 'Aucune permission',
                'no_roles'            => 'Aucun rôle à affecter.',
                'permissions'         => 'Permissions',
                'user_actions'        => 'User Actions',
                'table' => [
                    'confirmed'      => 'Confirmé',
                    'created'        => 'Création',
                    'email'          => 'Adresse email',
                    'username'          => 'Username',
                    'id'             => 'ID',
                    'last_updated'   => 'Mise à jour',
                    'name'           => 'Nom',
                    'first_name'     => 'Prénom',
                    'last_name'      => 'Nom',
                    'no_deactivated' => "Pas d'utilisateurs désactivés",
                    'no_deleted'     => "Pas d'utilisateurs supprimés",
                    'other_permissions' => 'Autres permissions',
                    'company'           => 'Company',
                    'permissions'    => 'Permissions',
                    'abilities'         => 'Abilities',
                    'roles'          => 'Rôles',
                    'social' => 'Réseau social',
                    'total'          => 'utilisateur total|utilisateurs total',
                ],
                'tabs' => [
                    'titles' => [
                        'overview' => 'Résumé',
                        'history'  => 'Historique',
                    ],
                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmé',
                            'created_at'   => 'Créé le',
                            'deleted_at'   => 'Supprimé le',
                            'email'        => 'Adresse email',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Mise à jour',
                            'name'         => 'Nom complet',
                            'first_name'   => 'Prénom',
                            'last_name'    => 'Nom',
                            'username'      => 'Username',
                            'phone'         => 'Telephone',
                            'status'       => 'Statut',
                            'timezone'     => 'Timezone',
                            'location'     => 'Location',
                        ],
                    ],
                ],
                'view' => 'Voir un utilisateur',
            ],
        ],
        'companies'  => [
            'company' => [
                'management'      => 'Company Management',
                'create'          => 'Create Company',
                'edit'            => 'Edit Company',
                'active'          => 'Active Companies',
                'company_actions' => 'Company Actions',
                'table' => [
                    'name'         => 'Company Name',
                    'address'      => 'Address',
                    'country'      => 'Country',
                    'state'        => 'State',
                    'city'         => 'City',
                    'phone'        => 'Company Phone',
                    'type'         => 'Company Type',
                    'email'        => 'Company Email',
                    'street'       => 'Street',
                    'website'      => 'Website',
                    'postal_code'  => 'Postal Code',
                    'size'         => 'Size',
                    'last_updated' => 'Size',
                    'active'       => 'Active',
                    'total'        => 'company|companies',
                ],
                'tabs'  => [
                    'titles'  => [
                        'profile'  => 'Profile',
                        'services' => 'Services'
                    ],
                    'content' => [
                        'service' => [
                            'management' => 'Service Rate',
                            'edit'       => 'Update service rate for :company',
                            'add'        => 'Add services for :company',
                            'default'    => 'Use service default',
                            'custom'     => 'Set custom',
                            'table'      => [
                                'name'               => 'Service Name',
                                'category'           => 'Service Category',
                                'gateway'            => 'Gateway Configuration',
                                'active'             => 'Active',
                                'code'               => 'Code',
                                'logo'               => 'Logo',
                                'company_rate'       => 'Specific Company Rate (%)',
                                'agent_rate'         => 'Specific Agent Rate (%)',
                                'customercommission' => 'Customer Service Charge',
                                'providercommission' => 'Provider Service Charge',
                                'total'              => 'service|services'
                            ]
                        ]
                    ]
                ],
            ],
        ],
        'services'   => [
            'service'    => [
                'management'      => 'Service Management',
                'create'          => 'Create Service',
                'edit'            => 'Edit Service',
                'active'          => 'Active Services',
                'service_actions' => 'Service Actions',
                
                'table' => [
                    'name'               => 'Service Name',
                    'code'               => 'Service Code',
                    'active'             => 'Active',
                    'logo'               => 'Logo',
                    'gateway'            => 'Gateway',
                    'category'           => 'Category',
                    'agent_rate'         => 'Default Agent Rate',
                    'company_rate'       => 'Default Company Rate',
                    'min_amount'         => 'Min Amount',
                    'max_amount'         => 'Max Amount',
                    'customercommission' => 'Default Customer Service Charge',
                    'providercommission' => 'Default Provider Service Charge',
                    'total'              => 'service|services',
                ],
            ],
            'category'   => [
                'management' => 'Service Category',
                'edit'       => 'Edit Category',
                'active'     => 'Active Categories',
                'table'      => [
                    'name'    => 'Category Name',
                    'code'    => 'Category Code',
                    'active'  => 'Active',
                    'logo'    => 'Logo',
                    'api_url' => 'Micro Service URL',
                    'api_key' => 'Micro Service API Key',
                    'total'   => 'category|categories',
                ]
            ],
            'commission' => [
                'management'         => 'Service Charge',
                'create'             => 'Create Service Charge',
                'edit'               => 'Edit Service Charge',
                'commission_actions' => 'Service Charge Actions',
                
                'table' => [
                    'name'        => 'Name',
                    'description' => 'Description',
                    'currency'    => 'Currency',
                    'view'        => 'View Stack',
                    
                    'total' => 'service charge|service charges',
                    'stack' => [
                        'title'      => 'Stack',
                        'from'       => 'From',
                        'to'         => 'To',
                        'percentage' => 'Percentage',
                        'fixed'      => 'Fixed',
                        'empty'      => 'Empty',
                    ],
                ],
            ],
            'method'     => [
                'management' => 'Payment Methods',
                'create'     => 'Create Payment Method',
                'edit'       => 'Edit Payment Method',
                'table'      => [
                    'name'               => 'Name',
                    'description_en'     => 'Description En',
                    'description_fr'     => 'Description Fr',
                    'code'               => 'Code',
                    'active'             => 'Active',
                    'realtime'           => 'Realtime',
                    'service'            => 'Service',
                    'logo'               => 'Logo',
                    'customercommission' => 'Customer Service Charge',
                    'providercommission' => 'Provider Service Charge',
                    'total'              => 'payment method|payment methods',
                ],
            ],
        ],
        'sales'      => [
            'management' => 'Sales',
            'table'      => [
                'code'               => 'Reference',
                'company'            => 'Company',
                'user'               => 'Agent',
                'items'              => 'Items',
                'service'            => 'Service',
                'total'              => 'Total',
                'destination'        => 'Destination',
                'payment_account'    => 'Payment Account',
                'company_commission' => 'Company Commission',
                'agent_commission'   => 'Agent Commission',
                'completed_at'       => 'Completed At',
                'user_status'        => 'User\'s Status',
                'actual_status'      => 'Actual Status',
                'total_sales'        => 'sales|sales',
            ]
        ],
        'account'    => [
            'management'            => 'Account',
            'company_balance'       => 'Company Balance',
            'umbrella_balance'      => 'Umbrella Balance',
            'commission_balance'    => 'Commission Balance',
            'credit'                => 'Credit Account',
            'debit'                 => 'Debit Account',
            'transfer_to_strongbox' => 'Transfer to Strongbox',
            'drain'                 => 'Drain Account',
            'float'                 => 'Add Float',
            'request_payout'        => 'Request Payout',
            'deposit'               => [
                'management' => 'Deposit Accounts',
                'actions'    => 'Account Actions',
                'view'       => 'View Account',
                'table'      => [
                    'code'    => 'Account Number',
                    'type'    => 'Account Type',
                    'owner'   => 'Owner',
                    'active'  => 'Active',
                    'balance' => 'Account Balance',
                    'total'   => 'account|accounts'
                ],
                'tabs'       => [
                    'titles'  => [
                        'overview'  => 'Overview',
                        'movements' => 'Movements',
                    ],
                    'content' => [
                        'overview'  => [
                            'code'    => 'Account Number',
                            'type'    => 'Account Type',
                            'owner'   => 'Owner',
                            'active'  => 'Active',
                            'balance' => 'Account Balance',
                        ],
                        'movements' => [
                            'table' => [
                                'code'        => 'Transaction Number',
                                'amount'      => 'Amount',
                                'type'        => 'Type',
                                'user'        => 'Executed By',
                                'source'      => 'Source Account',
                                'destination' => 'Destination Account',
                                'date'        => 'Date',
                                'reversal'    => 'reversal',
                                'cancelled'   => 'cancelled',
                                'total'       => 'movement|movements'
                            ],
                        ],
                    ],
                ],
            ],
            'umbrella'              => [
                'management' => 'Umbrella Accounts',
                'actions'    => 'Account Actions',
                'view'       => 'View Account',
                'table'      => [
                    'code'    => 'Account Number',
                    'owner'   => 'Owner',
                    'active'  => 'Active',
                    'balance' => 'Balance',
                    'total'   => 'account|accounts',
                    'user'    => 'User',
                ],
                'tabs'       => [
                    'titles'  => [
                        'overview'  => 'Overview',
                        'movements' => 'Movements',
                    ],
                    'content' => [
                        'overview'  => [
                            'code'    => 'Account Number',
                            'user'    => 'User',
                            'balance' => 'Account Balance',
                        ],
                        'movements' => [
                            'table' => [
                                'code'    => 'Transaction Number',
                                'amount'  => 'Amount',
                                'comment' => 'Comment',
                                'account' => 'Account',
                                'user'    => 'Executed by',
                                'company' => 'Company',
                                'date'    => 'Date',
                                'total'   => 'movement|movements',
                            ],
                        ],
                    ],
                ],
            ],
            'payout'                => [
                'management' => 'Commission Accounts',
                'actions'    => 'Account Actions',
                'view'       => 'View Account',
                'table'      => [
                    'code'    => 'Account Number',
                    'balance' => 'Commission Balance',
                    'pending' => 'Pending',
                    'total'   => 'account|accounts',
                    'owner'   => 'Owner',
                    'type'    => 'Type',
                ],
                'tabs'       => [
                    'titles'  => [
                        'overview'  => 'Overview',
                        'movements' => 'Movements',
                    ],
                    'content' => [
                        'overview'  => [
                            'code'    => 'Account Number',
                            'type'    => 'Account Type',
                            'owner'   => 'Owner',
                            'balance' => 'Commission Balance',
                        ],
                        'movements' => [
                            'table' => [
                                'code'        => 'Transaction Number',
                                'amount'      => 'Amount',
                                'method'      => 'Payout Method',
                                'number'      => 'Account Number',
                                'comment'     => 'Comment',
                                'name'        => 'Account Name',
                                'account'     => 'Account',
                                'user'        => 'Requested By',
                                'date'        => 'Requested At',
                                'company'     => 'Company',
                                'status'      => 'Status',
                                'decision_by' => 'Decision By',
                                'decision_at' => 'Decision At',
                                'total'       => 'movement|movements',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'accounting' => [
            'pay'        => 'Payout Collection',
            'request'    => 'Request Provision',
            'provision'  => [
                'management' => 'Provisions',
                'actions'    => 'Provision Actions',
                'view'       => 'View Provision',
                'table'      => [
                    'service'           => 'Service',
                    'commission'        => 'Commission',
                    'number_requests'   => 'Number of requests',
                    'last_request_date' => 'Last request date',
                    'total'             => 'service|services'
                ],
                'movements'  => [
                    'code'    => 'Transaction Number',
                    'amount'  => 'Amount',
                    'comment' => 'Comment',
                    'user'    => 'Executed by',
                    'date'    => 'Date',
                    'total'   => 'request|requests',
                ]
            ],
            'collection' => [
                'management' => 'Collections',
                'actions'    => 'Collection Actions',
                'view'       => 'View Collection',
                'table'      => [
                    'service'          => 'Service',
                    'amount'           => 'Collected Amount',
                    'number_payments'  => 'Number of payments',
                    'last_payout_date' => 'Last payout date',
                    'total'            => 'service|services'
                ],
                'movements'  => [
                    'code'    => 'Transaction Number',
                    'amount'  => 'Amount',
                    'comment' => 'Comment',
                    'user'    => 'Executed by',
                    'date'    => 'Date',
                    'total'   => 'payment|payments',
                ]
            ],
        ]
    ],
    'frontend' => [
        'auth' => [
            'login_box_title'    => 'Connexion',
            'login_to_account'   => 'Sign in to your account',
            'create_account'     => 'Create your account',
            'login_button'       => 'Entrer',
            'login_with'         => 'Se connecter avec :social_media',
            'register_box_title' => "S'enregistrer",
            'register_now'       => 'Register Now!',
            'no_account'         => 'Don\'t have an account?',
            'quick'              => ' It’s quick and easy.',
            'register_button'    => 'Créer le compte',
            'remember_me'        => 'Se souvenir de moi',
        ],
        'contact' => [
            'box_title' => 'Nous contacter',
            'button' => 'Envoyer le message',
        ],
        'confirm'   => [
            'confirm_account_box_title' => 'Confirm Your Account',
            'confirm_account_button'    => 'Confirm Account',
        ],
        'passwords' => [
            'expired_password_box_title'      => 'Your password has expired.',
            'forgot_password'                 => 'Avez-vous oublié votre mot de passe&nbsp;?',
            'reset_password_box_title'        => 'Réinitialisation du mot de passe',
            'reset_password_button'           => 'Réinitialiser le mot de passe',
            'update_password_button'          => 'Update Password',
            'send_password_reset_link_button' => 'Envoyer le lien de réinitialisation',
            'send_password_reset_code'        => 'Send Password Reset Code',
            'confirm_code_button'             => 'Confirm Code',
        ],
        'user' => [
            'passwords' => [
                'change' => 'Modifier le mot de passe',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Date de création',
                'edit_information'   => 'Éditer les informations',
                'email'              => 'Adresse email',
                'company'            => 'Company',
                'phone'              => 'Telephone',
                'username'           => 'Username',
                'last_updated'       => 'Date de mise à jour',
                'name'               => 'Nom complet',
                'first_name'         => 'Prénom',
                'last_name'          => 'Nom',
                'update_information' => 'Mettre à jour les informations',
            ],
        ],
    ],
];
