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
        'active'  => 'Actif',
        'toggle'             => 'Basculer',
        'buttons' => [
            'save'   => 'Enregistrer',
            'update' => 'Mettre à jour',
            'create' => 'Créer',
        ],
        'hide'              => 'Cacher',
        'inactive'          => 'Inactif',
        'none'              => 'Aucun',
        'show'              => 'Voir',
        'toggle_navigation' => 'Navigation',
        'create_new'         => 'Créer nouveau',
        'add'                => 'Ajouter',
        'remove'             => 'Retirer',
        'credit'             => 'Crédit',
        'debit'              => 'Débit',
        'toolbar_btn_groups' => 'Barre d\'outils avec boutons de groupes',
        'more'               => 'Plus',
        'select'             => 'Sélectionnez une option'
    ],
    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Créer un rôle',
                'edit'       => 'Modifier un rôle',
                'management' => 'Gestion des rôles',
                'table' => [
                    'number_of_users' => "Nombre d'utilisateurs",
                    'permissions'     => 'Permissions',
                    'role'            => 'Rôle',
                    'sort'            => 'Trier',
                    'total'           => 'rôle total|rôles total',
                ],
            ],
            'users' => [
                'active'              => 'Utilisateurs actifs',
                'all_permissions'     => 'Toutes les permissions',
                'change_password'     => 'Modifier le mot de passe',
                'change_password_for' => 'Modifier le mot de passe pour :user',
                'transfer_user'       => 'Transférer :utilissatur dans une nouvelle entreprise.',
                'create'              => 'Créer un utilisateur',
                'transfer'            => 'Transférer un utilisateur',
                'deactivated'         => 'Utilisateurs désactivés',
                'deleted'             => 'Utilisateurs supprimés',
                'edit'                => 'Modifier un utilisateur',
                'management'          => 'Gestion des utilisateurs',
                'no_permissions'      => 'Aucune permission',
                'no_roles'            => 'Pas de rôles à déterminer.',
                'permissions'         => 'Permissions',
                'user_actions'        => 'Actions des utilisateurs',
                'table' => [
                    'confirmed'      => 'Confirmé',
                    'created'        => 'Créé',
                    'email'          => 'Email',
                    'username'          => 'Nom d\'utilisateur',
                    'id'             => 'ID',
                    'last_updated'   => 'Dernière mise à jour',
                    'name'           => 'Nom',
                    'first_name'     => 'Prénom',
                    'last_name'      => 'Nom',
                    'no_deactivated' => "Pas d'utilisateurs désactivés",
                    'no_deleted'     => "Pas d'utilisateurs supprimés",
                    'other_permissions' => 'Autres permissions',
                    'company'           => 'Entreprise',
                    'permissions'    => 'Permissions',
                    'abilities'         => 'Fonctions',
                    'roles'          => 'Rôles',
                    'social' => 'Réseau social',
                    'total'          => 'utilisateur total|utilisateurs total',
                ],
                'tabs' => [
                    'titles' => [
                        'overview' => 'Aperçu',
                        'history'  => 'Historique',
                    ],
                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmé',
                            'created_at'   => 'Créé le',
                            'deleted_at'   => 'Supprimé le',
                            'email'        => 'Adresse email',
                            'last_login_at' => 'Dernière connexion à',
                            'last_login_ip' => 'Dernière connexion IP',
                            'last_updated' => 'Dernière mise à jour',
                            'name'         => 'Nom',
                            'first_name'   => 'Prénom',
                            'last_name'    => 'Nom',
                            'username'      => 'Nom d\'utilisateur',
                            'phone'         => 'Telephone',
                            'status'       => 'Statut',
                            'timezone'     => 'Fuseau horaire',
                            'location'     => 'Localisation',
                        ],
                    ],
                ],
                'view' => 'Voir un utilisateur',
            ],
        ],
        'companies'  => [
            'company' => [
                'management'      => 'Gestion de l\'entreprise',
                'create'          => 'Créer une entreprise',
                'edit'            => 'Modifier une entreprise',
                'active'          => 'Entreprises actives',
                'company_actions' => 'Actions des entreprises',
                'table' => [
                    'name'         => 'Nom de l\'entreprise',
                    'address'      => 'Adresse',
                    'country'      => 'Pays',
                    'state'        => 'Région',
                    'city'         => 'Ville',
                    'phone'        => 'Numéro de téléphone de l\'entreprise',
                    'type'         => 'Type d\'entreprise',
                    'email'        => 'Email de l\'entreprise',
                    'street'       => 'Rue',
                    'website'      => 'Site web',
                    'postal_code'  => 'Code  postal',
                    'size'         => 'Taille',
                    'last_updated' => 'Taille',
                    'active'       => 'Actif',
                    'total'        => 'entreprise|entreprises',
                ],
                'tabs'  => [
                    'titles'  => [
                        'profile'  => 'Profil',
                        'services' => 'Services'
                    ],
                    'content' => [
                        'service' => [
                            'management' => 'Frais de service',
                            'edit'       => 'Mettre à jour les frais de service pour :entreprise',
                            'add'        => 'Ajouter les services pour:entreprise',
                            'default'    => 'Utiliser le service par défaut',
                            'custom'     => 'Personnalisation',
                            'table'      => [
                                'name'               => 'Nom du service',
                                'category'           => 'Catégorie du service',
                                'gateway'            => 'Configuration de la passerelle',
                                'active'             => 'Actif',
                                'code'               => 'Code',
                                'logo'               => 'Logo',
                                'company_rate'       => 'Taux spécifique à l\'entreprise (%)',
                                'agent_rate'         => 'Taux spécifique à l\'agent (%)',
                                'customercommission' => 'Frais de service client',
                                'providercommission' => 'Frais de service fournisseur de service',
                                'total'              => 'service|services'
                            ]
                        ]
                    ]
                ],
            ],
        ],
        'services'   => [
            'service'    => [
                'management'      => 'Gestion de service',
                'create'          => 'Créer un service',
                'edit'            => 'Modifier le service',
                'active'          => 'Services activées',
                'service_actions' => 'Actions de service',
                
                'table' => [
                    'name'               => 'Nom du service',
                    'code'               => 'Code du service',
                    'active'             => 'Actif',
                    'logo'               => 'Logo',
                    'gateway'            => 'Passerelle',
                    'category'           => 'Catégorie',
                    'agent_rate'         => 'Taux par défaut de l\'agent',
                    'company_rate'       => 'Taux par défaut de l\'entreprise',
                    'min_amount'         => 'Montant minimal',
                    'max_amount'         => 'Montant maximal',
                    'customercommission' => 'Frais de service par défaut du client',
                    'providercommission' => 'Frais de service par défaut du fournisseur de service',
                    'total'              => 'service|services',
                ],
            ],
            'category'   => [
                'management' => 'Catégorie de service',
                'edit'       => 'Modifier la catégorie',
                'active'     => 'Catégories activées',
                'table'      => [
                    'name'    => 'Nom de la catégorie',
                    'code'    => 'Code de la catégorie',
                    'active'  => 'Actif',
                    'logo'    => 'Logo',
                    'api_url' => 'URL du micro-service',
                    'api_key' => 'Clé API de Micro Service',
                    'total'   => 'catégorie|catégories',
                ]
            ],
            'commission' => [
                'management'         => 'Frais de service',
                'create'             => 'Créer les frais de services',
                'edit'               => 'Modifier les frais de service',
                'commission_actions' => 'Actions en matière de frais de service',
                
                'table' => [
                    'name'        => 'Nom',
                    'description' => 'Description',
                    'currency'    => 'Devise',
                    'view'        => 'Voir Stack',
                    
                    'total' => 'Frais de service|Frais de services',
                    'stack' => [
                        'title'      => 'Stack',
                        'from'       => 'De',
                        'to'         => 'A',
                        'percentage' => 'Pourcentage',
                        'fixed'      => 'Fixé',
                        'empty'      => 'Vide',
                    ],
                ],
            ],
            'method'     => [
                'management' => 'Modes de paiement',
                'create'     => 'Créer modes de paiement',
                'edit'       => 'Modifier modes de paiement',
                'table'      => [
                    'name'               => 'Nom',
                    'description_en'     => 'Description En',
                    'description_fr'     => 'Description Fr',
                    'code'               => 'Code',
                    'active'             => 'Actif',
                    'realtime'           => 'Temps réel',
                    'service'            => 'Service',
                    'logo'               => 'Logo',
                    'customercommission' => 'Frais de service du client',
                    'providercommission' => 'Frais de service du fournisseur de service',
                    'total'              => 'mode de paiement|modes de paiements',
                ],
            ],
        ],
        'sales'      => [
            'management' => 'Sales',
            'table'      => [
                'code'               => 'Référence',
                'company'            => 'Entreprise',
                'user'               => 'Agent',
                'items'              => 'Articles',
                'service'            => 'Service',
                'total'              => 'Total',
                'destination'        => 'Destinataire',
                'payment_account'    => 'Compte de paiement',
                'company_commission' => 'Commission de l\'entreprise',
                'agent_commission'   => 'Commission de l\'agent',
                'completed_at'       => 'Terminé à',
                'user_status'        => 'Statut de l\'utilisateur',
                'actual_status'      => 'Statut actuel',
                'total_sales'        => 'Vente| ventes',
            ]
        ],
        'account'    => [
            'management'            => 'Compte',
            'company_balance'       => 'Solde de l\'entreprise',
            'umbrella_balance'      => 'Solde en espèces',
            'commission_balance'    => 'Solde de commission',
            'credit'                => 'Créditer le compte',
            'debit'                 => 'Débiter le compte',
            'transfer_to_strongbox' => 'Transférer au coffre-fort',
            'drain'                 => 'Décharger le compte',
            'float'                 => 'Ajouter la flotte',
            'request_payout'        => 'Demander un paiement',
            'deposit'               => [
                'management' => 'Comptes de dépôt',
                'actions'    => 'Actions sur le compte',
                'view'       => 'Voir le compte',
                'table'      => [
                    'code'    => 'Numéro de compte',
                    'type'    => 'Type de compte',
                    'owner'   => 'Titulaire',
                    'active'  => 'Actif',
                    'balance' => 'Solde du compte',
                    'total'   => 'compte|comptes'
                ],
                'tabs'       => [
                    'titles'  => [
                        'overview'  => 'Aperçu',
                        'movements' => 'Mouvements',
                    ],
                    'content' => [
                        'overview'  => [
                            'code'    => 'Numéro de compte',
                            'type'    => 'Type de compte',
                            'owner'   => 'Titulaire',
                            'active'  => 'Actif',
                            'balance' => 'Solde du compte',
                        ],
                        'movements' => [
                            'table' => [
                                'code'        => 'Numéro de transaction',
                                'amount'      => 'Montant',
                                'type'        => 'Type',
                                'user'        => 'Exécuté par',
                                'source'      => 'Compte fournisseur',
                                'destination' => 'Compte de destination',
                                'date'        => 'Date',
                                'reversal'    => 'inversion',
                                'cancelled'   => 'annulée',
                                'total'       => 'mouvement|mouvements'
                            ],
                        ],
                    ],
                ],
            ],
            'umbrella'              => [
                'management' => 'Comptes espèces',
                'actions'    => 'Actions sur le compte',
                'view'       => 'Voir le compte',
                'table'      => [
                    'code'    => 'Numéro de compte',
                    'owner'   => 'Titulaire',
                    'active'  => 'Actif',
                    'balance' => 'Solde',
                    'total'   => 'Compte|Comptes',
                    'user'    => 'Utilisateur',
                ],
                'tabs'       => [
                    'titles'  => [
                        'overview'  => 'Aperçu',
                        'movements' => 'Mouvements',
                    ],
                    'content' => [
                        'overview'  => [
                            'code'    => 'Numéro de compte',
                            'user'    => 'Utilisateur',
                            'balance' => 'Solde du compte',
                        ],
                        'movements' => [
                            'table' => [
                                'code'    => 'Numéro de transaction',
                                'amount'  => 'Montant',
                                'comment' => 'Commentaire',
                                'account' => 'Compte',
                                'user'    => 'Exécuté par',
                                'company' => 'Entreprise',
                                'date'    => 'Date',
                                'total'   => 'mouvement|mouvements',
                            ],
                        ],
                    ],
                ],
            ],
            'payout'                => [
                'management' => 'Comptes de Commission',
                'actions'    => 'Actions sur le compte',
                'view'       => 'Voir le compte',
                'table'      => [
                    'code'    => 'Numéro de compte',
                    'balance' => 'Solde de commission',
                    'pending' => 'En attente',
                    'total'   => 'Compte|comptes',
                    'owner'   => 'Titulaire',
                    'type'    => 'Type',
                ],
                'tabs'       => [
                    'titles'  => [
                        'overview'  => 'Aperçu',
                        'movements' => 'Mouvements',
                    ],
                    'content' => [
                        'overview'  => [
                            'code'    => 'Numéro de compte',
                            'type'    => 'Type de compte',
                            'owner'   => 'Titulaire',
                            'balance' => 'Solde de commission',
                        ],
                        'movements' => [
                            'table' => [
                                'code'        => 'Numéro de transaction',
                                'amount'      => 'Montant',
                                'method'      => 'Mode de paiement',
                                'number'      => 'Numéro de compte',
                                'comment'     => 'Commentaire',
                                'name'        => 'Nom du compte',
                                'account'     => 'Compte',
                                'user'        => 'Demandé par',
                                'date'        => 'Demandé à',
                                'company'     => 'Entreprise',
                                'status'      => 'Statut',
                                'decision_by' => 'Décision par',
                                'decision_at' => 'Décision à',
                                'total'       => 'mouvement|mouvements',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'accounting' => [
            'pay'        => 'Payer les collectes',
            'request'    => 'Demande de provision',
            'provision'  => [
                'management' => 'Provisions',
                'actions'    => 'Actions sur provision',
                'view'       => 'Voir Provision',
                'table'      => [
                    'service'           => 'Service',
                    'commission'        => 'Commission',
                    'number_requests'   => 'Nombre de demandes',
                    'last_request_date' => 'Date de dernière demande',
                    'total'             => 'service|services'
                ],
                'movements'  => [
                    'code'    => 'Numéro de transaction',
                    'amount'  => 'Montant',
                    'comment' => 'Commentaire',
                    'user'    => 'Exécuté par',
                    'date'    => 'Date',
                    'total'   => 'demande|demandes',
                ]
            ],
            'collection' => [
                'management' => 'Collectes',
                'actions'    => 'Actions sur les collectes',
                'view'       => 'Voir la collecte',
                'table'      => [
                    'service'          => 'Service',
                    'amount'           => 'Montant collecté',
                    'number_payments'  => 'Nombre de paiements',
                    'last_payout_date' => 'Date de derner paiement',
                    'total'            => 'service|services'
                ],
                'movements'  => [
                    'code'    => 'Numéro de transaction',
                    'amount'  => 'Montant',
                    'comment' => 'Commentaire',
                    'user'    => 'Exécuté par',
                    'date'    => 'Date',
                    'total'   => 'paiement|paiements',
                ]
            ],
        ]
    ],
    'frontend' => [
        'auth' => [
            'login_box_title'    => 'Connexion',
            'login_to_account'   => 'Connectez-vous à votre compte',
            'create_account'     => 'Créer votre compte',
            'login_button'       => 'Entrer',
            'login_with'         => 'Se connecter avec :réseau social',
            'register_box_title' => "S'enregistrer",
            'register_now'       => 'S\'inscrire maintenant!',
            'no_account'         => 'Vous n\'avez pas encore de compte',
            'quick'              => ' C\'est rapide et facile.',
            'register_button'    => 'Créer le compte',
            'remember_me'        => 'Se souvenir de moi',
        ],
        'contact' => [
            'box_title' => 'Contactez-nous',
            'button' => 'Envoyer le message',
        ],
        'confirm'   => [
            'confirm_account_box_title' => 'Confirmez votre compte',
            'confirm_account_button'    => 'Confirmer le compte',
        ],
        'passwords' => [
            'expired_password_box_title'      => 'Votre mot de passe a expiré.',
            'forgot_password'                 => 'Avez-vous oublié votre mot de passe;?',
            'reset_password_box_title'        => 'Réinitialisation du mot de passe',
            'reset_password_button'           => 'Réinitialiser le mot de passe',
            'update_password_button'          => 'Mise à jour du mot de passe',
            'send_password_reset_link_button' => 'Envoyer le lien de réinitialisation',
            'send_password_reset_code'        => 'Envoyer le code de réinitialisation du mot de passe',
            'confirm_code_button'             => 'Confirmer le code',
        ],
        'user' => [
            'passwords' => [
                'change' => 'Modifier le mot de passe',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Crée le',
                'edit_information'   => 'Modifier les informations',
                'email'              => 'Adresse email',
                'company'            => 'Entreprise',
                'phone'              => 'Telephone',
                'username'           => 'Nom d\'uutilisateur',
                'last_updated'       => 'Date de dernière mise à jour',
                'name'               => 'Nom',
                'first_name'         => 'Prénom',
                'last_name'          => 'Nom',
                'update_information' => 'Mettre à jour les informations',
            ],
        ],
    ],
];
