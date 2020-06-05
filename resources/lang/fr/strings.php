<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm'  => 'Êtes-vous sûr de vouloir supprimer cet utilisateur de façon permanente ? Toutes les références à cet utilisateur dans cette application peuvent provoquer des erreurs et cette opération ne peut être annullée.',
                'if_confirmed_off'     => '(pour le mode sans confirmation)',
                'no_deactivated'       => 'There are no deactivated users.',
                'no_deleted'           => 'There are no deleted users.',
                'restore_user_confirm' => 'Restaurer cet utilisateur à son statut original ?',
            ],
        ],

        'dashboard' => [
            'title'   => "Tableau de bord",
            'welcome' => 'Bienvenue',
            'company' => [
                'agents'                  => 'Agents',
                'users'                   => 'User|Users',
                'balance'                 => 'Account Balance',
                'number'                  => 'Company Account Number',
                'commission'              => 'Commission Balance',
                'system_commission'       => 'System Commission',
                'commission_today'        => 'Today\'s Commission',
                'commission_today_help'   => 'Commission earned today',
                'agents_balance'          => 'Agents\' Balance',
                'agents_commission'       => 'Agents\' Commission',
                'total_balance'           => 'Total Balance',
                'total_commission'        => 'Total Commission',
                'balance_help'            => 'The company\'s account balance',
                'agents_balance_help'     => 'The balance in all agents account',
                'agents_commission_help'  => 'The commission for all the agents',
                'total_balance_help'      => 'Total agent plus company balance',
                'commission_help'         => 'The company\'s commission balance',
                'strong_box_balance'      => 'Strong Box',
                'strong_box_balance_help' => 'The company\'s strongbox balance',
                'total_commission_help'   => 'Total agent plus company commission',
                'system_commission_help'  => 'System commission balance',
            ],
            'user'    => [
                'balance'         => 'Your balance',
                'balance_help'    => 'Your available balance',
                'commission'      => 'Your commission',
                'commission_help' => 'Your available commission'
            ]
        ],
        'general' => [
            'all_rights_reserved' => 'Tous droits réservés.',
            'are_you_sure'        => 'Êtes-vous sûr ?',
            'boilerplate_link'    => 'Laravel 5 Boilerplate',
            'corlang_link'        => 'Corlang',
            'continue'            => 'Continuer',
            'member_since'        => 'Membre depuis',
            'minutes'             => ' minutes.',
            'search_placeholder'  => 'Rechercher...',
            'timeout'             => 'Vous avez été automatiquement déconnecté pour cause d\'inactivité pendant ',

            'see_all' => [
                'messages'      => 'Voir tous les messages',
                'notifications' => 'Voir toutes les notifications',
                'tasks'         => 'Voir les nouvelles tâches',
            ],
            'status' => [
                'online'  => 'En ligne',
                'offline' => 'Hors ligne',
            ],
            'you_have' => [
                'messages'      => "{0} Vous n'avez pas de message|{1} Vous avez 1 message|[2,Inf] Vous avez :number messages",
                'notifications' => "{0} Vous n'avez pas de notification|{1} Vous avez 1 notification|[2,Inf] Vous avez :number notifications",
                'tasks'         => "{0} Vous n'avez pas de tâche affectée|{1} Vous avez 1 tâche affectée|[2,Inf] Vous avez :number tâches affectées",
            ],
        ],
        'search' => [
            'empty'      => 'Veuillez entrer un terme de recherche.',
            'incomplete' => 'Vous devez mettre en place votre propre logique pour ce système.',
            'title'      => 'Résultats de recherche',
            'results'    => 'Résultats de la recherche :query',
        ],
        'welcome' => 'Welcome to the Dashboard',
    ],
    'emails' => [
        'auth' => [
            'account_confirmed' => 'Votre compte a été confirmé.',
            'error'                   => 'Oups !',
            'greeting'                => 'Bonjour !',
            'user_greeting'           => 'Hello :first_name!',
            'regards'                 => 'Salutations,',
            'trouble_clicking_button' => "Si vous ne pouvez pas cliquer sur le bouton ':action_text', copiez et collez l'URL ci-dessous dans un navigateur:",
            'thank_you_for_using_app' => "Merci d'utiliser notre application !",

            'password_reset_subject'    => 'Votre lien de réinitialisation',
            'password_cause_of_email'   => 'Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour ce compte.',
            'password_if_not_requested' => "Si vous n'avez pas effectué cette demande, aucune autre action n'est requise.",
            'reset_password'            => 'Cliquez ici pour réinitialiser votre mot de passe',

            'click_to_confirm' => 'Cliquez ici pour confirmer votre compte :',
            'use_code_to_confirm'     => 'Use the code below to confirm your account:',
            'use_code_to_reset_email' => 'Use the code below to reset your password:',
            'use_code_to_confirm_sms' => 'Hello :first_name! Use the code :code to confirm your account on :app_name.',
            'use_code_to_reset_sms'   => 'Hello :first_name! Use the code :code to reset your password on :app_name.',

            'login_sms' => 'Visit our website to log into your account.'
        ],
        'companies' => [
            'companies' => [
                'sms'  => [
                    'company_created' => 'Hello :first_name! your companies :account has been created successfully on :app_name. ',
                    'login'           => 'Visit our website to log into your account.'
                ],
                'mail' => [
                    'company_created'         => 'Company Created',
                    'company_account_created' => 'Your companies :account has been created successfully on :app_name.',
                ],
            ]
        ],
        'contact' => [
            'email_body_title' => 'Vous avez une nouvelle prise de contact dont voici les détails :',
            'subject' => 'Nouvelle soumission du formulaire de contact sur :app_name !',
        ],
        'general' => [
            'user_greeting' => 'Hello :first_name!',
            'login'         => 'Click here to login to your account:',
            'regards'       => 'Regards,',
            'greeting'      => 'Hello!',
        ],
    ],
    'frontend' => [
        'test' => 'Test',
        'tests' => [
            'based_on' => [
                'permission' => 'Helper sur la base de la permissions : ',
                'role'       => 'Helper sur la base du rôle : ',
            ],
            'js_injected_from_controller' => 'Javascript injecté depuis un contrôleur',
            'using_blade_extensions' => 'Utilisation des extensions Blade',
            'using_access_helper' => [
                'array_permissions'     => "L'utilisateur doit disposer de toutes les permissions d'un tableau, identifiées soit par leur ID, soit par leur nom.",
                'array_permissions_not' => "L'utilisateur doit disposer d'au moins une des permissions d'un tableau, identifiées soit par leur ID, soit par leur nom.",
                'array_roles'           => "L'utilisateur doit disposer de tous les rôles d'un tableau, identifiés soit par leur ID, soit par leur nom.",
                'array_roles_not'       => "L'utilisateur doit disposer d'au moins un des rôles d'un tableau, identifiés soit par leur ID, soit par leur nom.",
                'permission_id'         => "L'utilisateur doit disposer d'une permission identifiée par son ID",
                'permission_name'       => "L'utilisateur doit disposer d'une permission identifiée par son nom",
                'role_id'               => "L'utilisateur doit disposer d'un rôle identifié par son ID",
                'role_name'             => "L'utilisateur doit disposer d'un rôle identifié par son nom",
            ],
            'view_console_it_works'          => 'Sur la console du navigateur, vous devriez voir \'it works!\', ce qui est produit depuis le FrontendController@index',
            'you_can_see_because'            => 'Vous voyez ce message car vous disposez du rôle \':role\' !',
            'you_can_see_because_permission' => 'Vous voyez ce message car vous disposez de la permission \':permission\' !',
        ],
        'general' => [
            'joined'        => 'Membre depuis',
        ],
        'user' => [
            'change_email_notice' => "Si vous changez votre adresse email vous serez déconnecté jusqu'à que vous confirmiez votre nouvelle adresse email.",
            'change_phone_notice'         => 'If you change your phone number, you will have to confirm your new phone number',
            'email_changed_notice' => 'Vous devez confirmer votre nouvelle adresse email avant de pouvoir vous connecter de nouveau.',
            'cannot_change_email_notice'  => 'You cannot change your e-mail address. This is your default notification means',
            'cannot_change_phone_notice'  => 'You cannot change your phone number. This is your default notification means',
            'profile_updated'  => 'Profil modifié avec succès.',
            'password_updated' => 'Mot de passe modifié avec succès.',
            'pin_changed'                 => 'Your pin code was changed successfully.',
            'pin_created'                 => 'Your pin code was created successfully.',
            'topup_updated'               => 'Your Topup configuration has been updated successfully.',
            'topup_account_change_notice' => 'Once a topup account is confirmed by the system. It cannot be changed except you contact support.'
        ],
        'welcome_to' => 'Bienvenue sur :place',
        'what_we_do'              => 'What We Do',
        'our_services'            => 'Our Services',
        'how_to_become_a_partner' => 'How To Become A Partner',
        'our_partners'            => 'Our Partners',
        'services' => [
            'prepaid_bills'    => [
                'title'       => 'Prepaid Utility Bills',
                'description' => 'Our platform facilitates prepayment of utility services through purchasing credits affiliated with a meter in customer\'s home',
            ],
            'postpaid_bills'   => [
                'title'       => 'Postpaid Utility Bills',
                'description' => 'We facilitate payment of postpaid utility bills such as Electricity and Water bills.',
            ],
            'mobile_money'     => [
                'title'       => 'Mobile Money Services',
                'description' => 'Store, send, and receive money through our platform.',
            ],
            'airtime_recharge' => [
                'title'       => 'Mobile Airtime Recharge',
                'description' => 'We facilitate the purchase of airtime, mobile data, sms etc. with your network provider.'
            ],
            'ticket' => [
                'title' => 'Ticket',
                'description' => 'Buy your tickets easily at our points of sale. Cinema, Travel, Concert etc.'
            ],
            'ecommerce' => [
                'title' => 'E-commerce',
                'description' => 'Purchase goods online from your favorite online shop integrated with us.'
            ]
        ],
        'partner'  => [
            'steps' => [
                '1' => 'Contact us',
                '2' => 'Submit KYC documents',
                '3' => 'Get integrated',
                '4' => 'Start selling and earning',
            ]
        ],
        'what_we_do_details' => [
            'tagline' => 'We help businesses sell to their customers through our large network of agents.',
            'agent' => [
                'title' => 'Agents',
                'description' => 'Join our fast growing network of agents and start earning commissions with a single capital and single platform for all the services.'
            ],
            'biller' => [
                'title' => 'Billers / Merchants',
                'description' => 'With our simple APIs, plugins, platform, we can integrate your business very easily and start collecting your payments and improving on your processes.',
            ],
            'distributor' => [
                'title' => 'Distributors',
                'description' => 'With our SIMPLE but POWERFUL API, you can sell over our platform or create your agents\' accounts directly in our platform and start selling and earning commissions'
            ]
        ]
    ],
];
