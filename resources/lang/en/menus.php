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
            'title' => 'Users',

            'roles' => [
                'all'        => 'All Roles',
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'All Users',
                'change-password' => 'Change Password',
                'transfer-user'   => 'Transfer User',
                'create'          => 'Create User',
                'deactivated'     => 'Deactivated Users',
                'deleted'         => 'Deleted Users',
                'edit'            => 'Edit User',
                'main'            => 'Users',
                'view'            => 'View User',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'sales' => 'Sales',
            'orders' => 'Merchant Orders',
            'horizon' => 'Horizon',
            'general'   => 'General',
            'history'   => 'History',
            'system'    => 'System',
            'business'  => 'Business',
            'access'    => 'Access',
        ],
        'companies' => [
            'title' => 'Companies',
    
            'company' => [
                'management' => 'Companies',
                'create'     => 'Create Company',
                'edit'       => 'Edit Company',
            ],
        ],

        'services' => [
            'title' => 'Services',
    
            'service'   => [
                'management' => 'Services',
                'create'     => 'Create Service',
                'edit'       => 'Edit Service',
            ],
            'category' => [
                'management' => 'Categories',
                'edit' => 'Edit Category',
            ],
            'commission' => [
                'management' => 'Service Charges',
                'create'     => 'Create Service Charge',
                'edit'       => 'Edit Service Charge',
            ],
            'distribution' => [
                'management' => 'Commission Distribution Strategy',
                'create'     => 'Create Distribution Strategy',
                'edit'       => 'Edit Distribution Strategy',
            ],
            'method' => [
                'management' => 'Payment Methods',
                'create'     => 'Create Payment Method',
                'edit'       => 'Edit Payment Method',
            ]
        ],
        'sales' => [
            'management' => 'Sales',
            'clear' => 'Clear Filters',
            'reset' => 'Reset Filters',
        ],
        'orders' => [
            'management' => 'Merchant Orders',
            'clear' => 'Clear Filters',
            'reset' => 'Reset Filters',
        ],
        'accounts' => [
            'title' => 'Accounts',
            
            'deposit' => [
                'management' => 'Deposit Account',
                'view' => 'View Account'
            ],
            'umbrella' => [
                'management' => 'Cash Account',
                'view' => 'View Account',
            ],
            'payout' => [
                'management' => 'Commission Account',
                'view' => 'View Account',
            ]
        ],
        'accounting' => [
            'title' => 'Accounting',
            'collections' => [
                'management' => 'Collections',
                'view' => 'View Collection'
            ],
            'provisions' => [
                'management' => 'Provisions',
                'view' => 'View Provisions',
            ],
        ]
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fa'    => 'Persian',
            'fr'    => 'French',
            'he'    => 'Hebrew',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'no'    => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
        ],
    ],
];
