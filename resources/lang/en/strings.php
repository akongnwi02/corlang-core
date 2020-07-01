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
    
    'backend'  => [
        'access' => [
            'users' => [
                'delete_user_confirm'  => 'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error. Proceed at your own risk. This can not be un-done.',
                'if_confirmed_off'     => '(If confirmed is off)',
                'no_deactivated'       => 'There are no deactivated users.',
                'no_deleted'           => 'There are no deleted users.',
                'restore_user_confirm' => 'Restore this user to its original state?',
            ],
        ],
        
        'dashboard' => [
            'title'   => 'Dashboard',
            'welcome' => 'Welcome',
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
        'general'   => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure'        => 'Are you sure you want to do this?',
            'boilerplate_link'    => 'Laravel 5 Boilerplate',
            'corlang_link'        => 'Corlang Limited',
            'powered_by'          => 'Powered by',
            'continue'            => 'Continue',
            'member_since'        => 'Member since',
            'minutes'             => ' minutes',
            'search_placeholder'  => 'Search...',
            'timeout'             => 'You were automatically logged out for security reasons since you had no activity in ',
            'see_all'             => [
                'messages'      => 'See all messages',
                'notifications' => 'View all',
                'tasks'         => 'View all tasks',
            ],
            'status'              => [
                'online'  => 'Online',
                'offline' => 'Offline',
            ],
            'you_have'            => [
                'messages'      => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks'         => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],
        'search'    => [
            'empty'      => 'Please enter a search term.',
            'incomplete' => 'You must write your own search logic for this system.',
            'title'      => 'Search Results',
            'results'    => 'Search Results for :query',
        ],
        'welcome'   => 'Welcome to the Dashboard',
    ],
    'emails'   => [
        'auth'      => [
            'account_confirmed'       => 'Your account has been confirmed. ',
            'error'                   => 'Whoops!',
            'greeting'                => 'Hello!',
            'user_greeting'           => 'Hello :first_name!',
            'regards'                 => 'Regards,',
            'trouble_clicking_button' => 'If you’re having trouble clicking the ":action_text" button, copy and paste the URL below into your web browser:',
            'thank_you_for_using_app' => 'Thank you for using our application!',
            
            'password_reset_subject'    => 'Reset Password',
            'password_cause_of_email'   => 'You are receiving this email because we received a password reset request for your account.',
            'password_if_not_requested' => 'If you did not request a password reset, no further action is required.',
            'reset_password'            => 'Click here to reset your password',
            
            'click_to_confirm'        => 'Click here to confirm your account:',
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
        'contact'   => [
            'email_body_title' => 'You have a new contact form request: Below are the details:',
            'subject'          => 'A new :app_name contact form submission!',
        ],
        'general'   => [
            'user_greeting' => 'Hello :first_name!',
            'login'         => 'Click here to login to your account:',
            'regards'       => 'Regards,',
            'greeting'      => 'Hello!',
        ],
    ],
    'frontend' => [
        'test'                    => 'Test',
        'tests'                   => [
            'based_on'                       => [
                'permission' => 'Permission Based - ',
                'role'       => 'Role Based - ',
            ],
            'js_injected_from_controller'    => 'Javascript Injected from a Controller',
            'using_blade_extensions'         => 'Using Blade Extensions',
            'using_access_helper'            => [
                'array_permissions'     => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles'           => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not'       => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id'         => 'Using Access Helper with Permission ID',
                'permission_name'       => 'Using Access Helper with Permission Name',
                'role_id'               => 'Using Access Helper with Role ID',
                'role_name'             => 'Using Access Helper with Role Name',
            ],
            'view_console_it_works'          => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because'            => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],
        'general'                 => [
            'joined' => 'Joined',
        ],
        'user'                    => [
            'change_email_notice'         => 'If you change your e-mail you will have to confirm your new e-mail address.',
            'change_phone_notice'         => 'If you change your phone number, you will have to confirm your new phone number',
            'email_changed_notice'        => 'You must confirm your new e-mail address before you can log in again.',
            'cannot_change_email_notice'  => 'You cannot change your e-mail address. This is your default notification means',
            'cannot_change_phone_notice'  => 'You cannot change your phone number. This is your default notification means',
            'profile_updated'             => 'Profile successfully updated.',
            'password_updated'            => 'Password successfully updated.',
            'pin_changed'                 => 'Your pin code was changed successfully.',
            'pin_created'                 => 'Your pin code was created successfully.',
            'topup_updated'               => 'Your Topup configuration has been updated successfully.',
            'topup_account_change_notice' => 'Once a topup account is confirmed by the system, it cannot be changed except you contact support.'
        ],
        'welcome_to'              => 'Welcome to :place',
        'what_we_do'              => 'What We Do',
        'our_services'            => 'Our Services',
        'how_to_become_a_partner' => 'How To Become A Partner',
        'our_partners'            => 'Our Partners',
        'services'                => [
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
            'ticket'           => [
                'title'       => 'Ticket',
                'description' => 'Buy your tickets easily at our points of sale. Cinema, Travel, Concert etc.'
            ],
            'ecommerce'        => [
                'title'       => 'E-commerce',
                'description' => 'Purchase goods online from your favorite online shop integrated with us.'
            ]
        ],
        'partner'                 => [
            'steps' => [
                '1' => 'Contact us',
                '2' => 'Submit KYC documents',
                '3' => 'Get integrated',
                '4' => 'Start selling and earning',
            ]
        ],
        'what_we_do_details'      => [
            'tagline'     => 'We help businesses sell to their customers through our large network of agents.',
            'agent'       => [
                'title'       => 'Agents',
                'description' => 'Join our fast growing network of agents and start earning commissions with a single capital and single platform for all the services.'
            ],
            'biller'      => [
                'title'       => 'Billers / Merchants',
                'description' => 'With our simple APIs, plugins, platform, we can integrate your business very easily and start collecting your payments and improving on your processes.',
            ],
            'distributor' => [
                'title'       => 'Distributors',
                'description' => 'With our SIMPLE but POWERFUL API, you can sell over our platform or create your agents\' accounts directly in our platform and start selling and earning commissions'
            ]
        ],
        'contact_us'              => [
            'title'      => 'Love to Hear From You',
            'text'       => 'We are now available twenty-four hours a day, seven days a week. Call us today and find out how we can help your business.',
            'company'    => 'Company',
            'address'    => 'Address',
            'phone'      => 'Phone',
            'email'      => 'Email',
            'website'    => 'Website',
            'work_hours' => 'Work Hours',
            'monday'     => 'Monday',
            'saturday'   => 'Saturday',
            'to'         => 'to',
        ]
    ],
];
