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
        'buttons'            => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'               => 'Hide',
        'inactive'           => 'Inactive',
        'none'               => 'None',
        'show'               => 'Show',
        'toggle_navigation'  => 'Toggle Navigation',
        'create_new'         => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more'               => 'More',
    ],

    'backend' => [
        'access' => [
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
        'companies' => [
            'company' => [
                'management'      => 'Company Management',
                'create'          => 'Create Company',
                'edit'            => 'Edit Company',
                'active'          => 'Active Companies',
                'company_actions' => 'Company Actions',
                
                'table' => [
                    'name'          => 'Company Name',
                    'address'       => 'Address',
                    'country'       => 'Country',
                    'state'         => 'State',
                    'city'          => 'City',
                    'phone'         => 'Company Phone',
                    'type'          => 'Company Type',
                    'email'         => 'Company Email',
                    'street'        => 'Street',
                    'website'       => 'Website',
                    'postal_code'   => 'Postal Code',
                    'size'          => 'Size',
                    'last_updated'  => 'Size',
                    'active'        => 'Active',
                    'total'         => 'company|companies',

                ],
                'tabs' => [
                    'titles' => [
                        'profile' => 'Profile',
                    ],
                ]
            ],
        ],
        'services' => [
            'service'    => [
                'management'      => 'Service Management',
                'create'          => 'Create Service',
                'edit'            => 'Edit Service',
                'active'          => 'Active Services',
                'service_actions' => 'Service Actions',
        
                'table' => [
                    'name'     => 'Service Name',
                    'code'     => 'Service Code',
                    'active'   => 'Active',
                    'gateway'  => 'Gateway',
                    'category' => 'Category',
                    'total'    => 'service|services',
                ],
            ],
            'commission' => [
                'management'         => 'Commission Management',
                'create'             => 'Create Commission',
                'edit'               => 'Edit Commission',
                'commission_actions' => 'Commission Actions',
    
                'table' => [
                    'name'        => 'Name',
                    'description' => 'Description',
                    'currency'    => 'Currency',

                    'total'       => 'commission|commissions',
                    'stack'       => [
                        'title'      => 'Stack',
                        'from'       => 'From',
                        'to'         => 'To',
                        'percentage' => 'Percentage',
                        'fixed'      => 'Fixed',
                        'no_result'  => 'No result',
                    ],
                ],
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
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
            'forgot_password'                 => 'Forgot Your Password?',
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
