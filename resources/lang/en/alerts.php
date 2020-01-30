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
        ],
        
        'companies' => [
            'company' => [
                'created' => 'The company was successfully created.',
                'updated' => 'The company was successfully updated.',
                'status_updated' => 'The status was successfully updated',
            ]
        ],
        'services' => [
            'service' => [
                'created' => 'The service was successfully created.',
                'updated' => 'The service was successfully updated.',
                'status_updated' => 'The status was successfully updated',
            ]
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
