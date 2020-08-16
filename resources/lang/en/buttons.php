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
                'activate'           => 'Activate',
                'change_password'    => 'Change Password',
                'clear_session'      => 'Clear Session',
                'confirm'            => 'Confirm',
                'deactivate'         => 'Deactivate',
                'delete_permanently' => 'Delete Permanently',
                'login_as'           => 'Login As :user',
                'resend_email'       => 'Resend Confirmation E-mail',
                'restore_user'       => 'Restore User',
                'transfer_user'      => 'Transfer User',
                'reset_pin'          => 'Reset Pin Code',
                'reset_topup_account'          => 'Reset Top up Account',
                'unconfirm'          => 'Un-confirm',
                'unlink'             => 'Unlink',
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
        'administration' => [
            'currency' => [
                'activate' => 'Activate Currency',
                'deactivate' => 'Deactivate Currency'
            ],
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
            'confirm_account' => 'Confirm Account',
            'reset_password'  => 'Reset Password',
        ],
    ],

    'general' => [
        'cancel' => 'Cancel',
        'back'   => 'Back',
        'continue' => 'Continue',
        'submit'   => 'Submit',

        'crud' => [
            'create' => 'Create',
            'delete' => 'Delete',
            'edit'   => 'Edit',
            'update' => 'Update',
            'view'   => 'View',
        ],
        
        'filter' => [
            'filter' => 'Filter',
            'reset' => 'Reset',
            'clear' => 'Clear',
        ],

        'save' => 'Save',
        'view' => 'View',
    ],
];
