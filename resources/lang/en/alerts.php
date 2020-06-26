<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_message'     => 'A new confirmation message has been sent to the address on file.',
            'confirmed'                => 'The user was successfully confirmed.',
            'created'                  => 'The user was successfully created.',
            'deleted'                  => 'The user was successfully deleted.',
            'deleted_permanently'      => 'The user was deleted permanently.',
            'restored'                 => 'The user was successfully restored.',
            'session_cleared'          => "The user's session was successfully cleared.",
            'social_deleted'           => 'Social Account Successfully Removed',
            'unconfirmed'              => 'The user was successfully un-confirmed',
            'updated'                  => 'The user was successfully updated.',
            'transferred'                 => 'The user was successfully transferred.',
            'updated_password'         => "The user's password was successfully updated.",
            'reset_pin'         => "The user's pin was successfully reset.",
            'reset_topup_account'         => "The user's top up accounts were successfully reset.",
        ],
        
        'companies' => [
            'company' => [
                'created' => 'The company was successfully created.',
                'updated' => 'The company was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
                'logged_in'     => 'You have changed company successfully.',
            ],
            'service' => [
                'status_updated' => 'The status was successfully updated.',
                'updated' => 'The service was updated for this company successfully.',
            ],
            'method' => [
                'status_updated' => 'The status was successfully updated.',
                'updated' => 'The payment method was updated for this company successfully.',
            ]
        ],
        'services' => [
            'service' => [
                'created' => 'The service was successfully created.',
                'updated' => 'The service was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
            ],
            'category' => [
                'created' => 'The category was successfully created.',
                'updated' => 'The category was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
            ],
            'commission' => [
                'created' => 'The service charge was updated successfully.',
            ],
            'method' => [
                'created' => 'The payment method was successfully created.',
                'updated' => 'The payment method was successfully updated.',
                'status_updated' => 'The status was successfully updated.',
            ]
        ],
        'accounting' => [
            'collection' => [
                'paid' => 'The collection was paid successfully.'
            ],
            'provision' => [
                'requested' => 'The provision was requested successfully.',
            ]
        ],
        'account' => [
            'floated' => 'Float applied successfully.',
            'transferred' => 'Amount transferred successfully,',
            'status_updated' => 'The status was successfully updated.',
            'drained' => 'Amount drained successfully.',
            'paid_out' => 'The payout request was successful. The request is pending validation.',
        ],
        'payout' => [
            'status_updated' => 'Payout status updated successfully.'
        ]
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
    'api'      => [
        'users' => [
            'logged_out' => 'User logged out successfully.'
        ]
    ]
];
