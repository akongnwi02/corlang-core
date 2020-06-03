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
        'all'                => 'All',
        'yes'                => 'Yes',
        'no'                 => 'No',
        'copyright'          => 'Copyright',
        'custom'             => 'Custom',
        'actions'            => 'Actions',
        'active'             => 'Active',
        'toggle'             => 'Toggle',
        'buttons'            => [
            'save'   => 'Save',
            'update' => 'Update',
            'create' => 'Create',
        ],
        'hide'               => 'Hide',
        'inactive'           => 'Inactive',
        'none'               => 'None',
        'show'               => 'Show',
        'toggle_navigation'  => 'Toggle Navigation',
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
        'access'     => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',
                
                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],
            
            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'transfer_user'       => 'Transfer :user to a new Company.',
                'create'              => 'Create User',
                'transfer'            => 'Transfer User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',
                'user_actions'        => 'User Actions',
                
                'table' => [
                    'confirmed'         => 'Confirmed',
                    'created'           => 'Created',
                    'email'             => 'E-mail',
                    'username'          => 'Username',
                    'id'                => 'ID',
                    'last_updated'      => 'Last Updated',
                    'name'              => 'Name',
                    'first_name'        => 'First Name',
                    'last_name'         => 'Last Name',
                    'no_deactivated'    => 'No Deactivated Users',
                    'no_deleted'        => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'company'           => 'Company',
                    'permissions'       => 'Permissions',
                    'abilities'         => 'Abilities',
                    'roles'             => 'Roles',
                    'social'            => 'Social',
                    'total'             => 'user total|users total',
                ],
                
                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],
                    
                    'content' => [
                        'overview' => [
                            'avatar'        => 'Avatar',
                            'confirmed'     => 'Confirmed',
                            'created_at'    => 'Created At',
                            'deleted_at'    => 'Deleted At',
                            'email'         => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated'  => 'Last Updated',
                            'name'          => 'Name',
                            'first_name'    => 'First Name',
                            'last_name'     => 'Last Name',
                            'username'      => 'Username',
                            'phone'         => 'Telephone',
                            'status'        => 'Status',
                            'timezone'      => 'Timezone',
                            'location'      => 'Location',
                        ],
                    ],
                ],
                
                'view' => 'View User',
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
            'login_box_title'    => 'Login',
            'login_to_account'   => 'Sign in to your account',
            'create_account'     => 'Create your account',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_now'       => 'Register Now!',
            'no_account'         => 'Don\'t have an account?',
            'quick'              => ' It’s quick and easy.',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],
        
        'contact' => [
            'box_title' => 'Contact Us',
            'button'    => 'Send Information',
        ],
        
        'confirm'   => [
            'confirm_account_box_title' => 'Confirm Your Account',
            'confirm_account_button'    => 'Confirm Account',
        ]
        ,
        'passwords' => [
            'expired_password_box_title'      => 'Your password has expired.',
            'forgot_password'                 => 'Forgot Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'update_password_button'          => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
            'send_password_reset_code'        => 'Send Password Reset Code',
            'confirm_code_button'             => 'Confirm Code',
        ],
        
        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],
            
            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'company'            => 'Company',
                'phone'              => 'Telephone',
                'username'           => 'Username',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],
    
    ],
];
