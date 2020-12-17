<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists'    => 'That role already exists. Please choose a different name.',
                'cant_delete_admin' => 'You can not delete the Administrator role.',
                'create_error'      => 'There was a problem creating this role. Please try again.',
                'delete_error'      => 'There was a problem deleting this role. Please try again.',
                'has_users'         => 'You can not delete a role with associated users.',
                'needs_permission'  => 'You must select at least one permission for this role.',
                'not_found'         => 'That role does not exist.',
                'update_error'      => 'There was a problem updating this role. Please try again.',
                'name_exists'       => 'A role already exists with the name :name.',
            ],
            'users' => [
                'already_confirmed'       => 'This user is already confirmed.',
                'cant_confirm'            => 'There was a problem confirming the user account.',
                'cant_deactivate_self'    => 'You can not do that to yourself.',
                'cant_delete_admin'       => 'You can not delete the super administrator.',
                'cant_delete_self'        => 'You can not delete yourself.',
                'cant_delete_own_session' => 'You can not delete your own session.',
                'cant_restore'            => 'This user is not deleted so it can not be restored.',
                'cant_unconfirm_admin'    => 'You can not un-confirm the super administrator.',
                'cant_unconfirm_self'     => 'You can not un-confirm yourself.',
                'create_error'            => 'There was a problem creating this user. Please try again.',
                'delete_error'            => 'There was a problem deleting this user. Please try again.',
                'delete_first'            => 'This user must be deleted first before it can be destroyed permanently.',
                'username_error'          => 'That username belongs to a different user.',
                'email_error'             => 'That email belongs to a different user.',
                'phone_error'             => 'That phone number belongs to a different user.',
                'mark_error'              => 'There was a problem updating this user. Please try again.',
                'not_confirmed'           => 'This user is not confirmed.',
                'not_found'               => 'That user does not exist.',
                'restore_error'           => 'There was a problem restoring this user. Please try again.',
                'role_needed_create'      => 'You must choose at lease one role.',
                'role_needed'             => 'You must choose at least one role.',
                'session_wrong_driver'    => 'Your session driver must be set to database to use this feature.',
                'social_delete_error'     => 'There was a problem removing the social account from the user.',
                'update_error'            => 'There was a problem updating this user. Please try again.',
                'transfer_error'          => 'There was a problem transferring this user. Please try again.',
                'update_password_error'   => 'There was a problem changing this user\'s password. Please try again.',
                'reset_pin_error'         => 'There was a problem resetting this user\'s pin code. Please try again.',
                'reset_topup_account_error'         => 'There was a problem resetting this user\'s top up accounts. Please try again.',
            ],
        ],
        'companies' => [
            'company' => [
                'create_error'          => 'There was a problem creating this company. Please try again.',
                'update_error'          => 'There was a problem updating this company. Please try again.',
                'mark_error'            => 'There was a problem updating the status of this company. Please try again.',
                'mark_rights_error'     => 'There was a problem updating the status of this company. The company was deactivated by a higher role.',
                'cant_change_attribute' => 'You are not permitted to change the :attribute',
                'cant_change_check_box' => 'You are not allowed to change one of the checkbox values',
                'invalid_service'       => 'An invalid service has been provided',
                'invalid_method'       => 'An invalid payment method has been provided',
                'login_error'           => 'There was a problem logging into this company. Please try again.',
                'inactive'              => 'There was a problem processing the request. This company is inactive',
            ],
            'service' => [
                'mark_error'   => 'There was a problem updating the status of this service for this company. Please try again.',
                'update_error' => 'There was a problem updating this service for this company. Please try again.',
            ],
            'method' => [
                'mark_error'   => 'There was a problem updating the status of this payment method for this company. Please try again.',
                'update_error' => 'There was a problem updating this payment method for this company. Please try again.',
            ]
        ],
        'account' => [
            'mark_error'              => 'There was an error freezing this account.',
            'inactive'                => 'There was a problem authorizing the transaction. Account is inactive.',
            'insufficient_balance'    => 'There was a problem authorizing the transaction. Insufficient funds',
            'insufficient_drain'      => 'Insufficient funds in umbrella account',
            'insufficient_commission' => 'Insufficient funds in commission account',
        ],
        'accounting' => [
            'insufficient_provision_amount' => 'The :attribute is more than the commission amount',
            'insufficient_collected_amount' => 'The :attribute is more than the collected amount',
            'provision_request_error' => 'There was a problem requesting the provision. Please try again.',
            'collection_payment_error' => 'There was a problem paying out the collection. Please try again.'
        ],
        'movement' => [
            'create_error' => 'There was a problem performing this operation. Please try again.',
        ],
        'services' => [
            'service'    => [
                'create_error'  => 'There was a problem creating this service. Please try again.',
                'update_error'  => 'There was a problem updating this service. Please try again.',
                'mark_error'    => 'There was a problem updating the status of this service. Please try again.',
                'invalid_items' => 'The :attribute contain some invalid values',
                'invalid_company' => 'An invalid company has been provided',
            ],
            'commission' => [
                'create_error'     => 'There was a problem creating this commission. Please try again.',
                'update_error'     => 'There was a problem updating this commission. Please try again.',
                'invalid_pricings' => 'The :attribute contain some invalid values',
            ],
            'distribution' => [
                'create_error' => 'There was an error creating the distribution',
                'sum_error'    => 'The sum of the commission distributions must not be greater than 100%',
                'update_error' => 'There was an error updating the distribution',
            ],
            'method'     => [
                'create_error' => 'There was a problem creating this payment method. Please try again.',
                'update_error' => 'There was a problem updating this payment method. Please try again.',
                'mark_error'   => 'There was a problem updating the status of this payment method. Please try again.',
                'company_update_error' => 'The was a problem updating the assignments of this payment method',
            ],
            'company' => [
                'update_error' => 'The was a problem updating the assignments of this service'
            ],
            'category' => [
                'update_error' => 'There was a problem updating this category. Please try again.',
                'mark_error'   => 'There was a problem updating the status of this category. Please try again.',
            ],
            'topup' => [
                'update_error' => 'They was a problem updating the :method payment method. It has already been confirmed by the system. Please contact support.'
            ]
        ],
        'administration' => [
            'currency' => [
                'create_error' => 'There was a problem creating this currency. Please try again.',
                'update_error' => 'There was a problem updating this currency. Please try again.',
                'mark_error'   => 'There was a problem updating the status of this currency. Please try again.',
            ]
        ],
        'payout'   => [
            'drain_error'      => 'There was an error draining the amount',
            'transfer_error'   => 'There was a problem transferring the amount to the strongbox.',
            'payout_error'     => 'There was a problem executing the payout. Please try again.',
            'no_company_error' => 'The user belongs to no company',
            'invalid_status'   => 'Invalid payout status.',
            'status_error'     => 'There was a problem updating the status of the payout. Please try again.',
            'state_error'     => 'There was a problem updating the status of the payout. The payout is in a final state.'
        ]
    ],
    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed'    => 'Your account is already confirmed.',
                'confirm'              => 'Confirm your account!',
                'created_confirm'      => 'Your account was successfully created. We have sent a code to :account to confirm your account.',
                'created_pending'      => 'Your account was successfully created and is pending approval. A message will be sent when your account is approved.',
                'mismatch'             => 'Your confirmation code does not match.',
                'not_found'            => 'That confirmation code does not exist.',
                'pending'              => 'Your account is currently pending approval.',
                'resend'               => 'Your account is not confirmed. Please click the confirmation link in your e-mail, or <a href=":url">click here</a> to resend the confirmation e-mail.',
                'confirm_pending'      => 'Please confirm your account. Enter the code sent to :account, or <a href=":url">click here</a> to resend the code.',
                'success'              => 'Your account has been successfully confirmed!',
                'resent'               => 'A new confirmation e-mail has been sent to the address on file.',
                'code_resent'          => 'A new confirmation code has been sent to :account. <a href=":url">Resend</a>',
                'code_reset_resent'    => 'A new password reset code has been sent to :account. <a href=":url">Resend</a>',
                'code_reset_not_found' => 'The password reset code does not exist',
                'no_company'           => 'You have a business account which is not linked to any company at the moment.',
                'deactivated_company'  => 'You have a business account and your company has been deactivated. Please contact your company administrator.',
            ],
            'deactivated'            => 'Your account has been deactivated.',
            'email_taken'            => 'That e-mail address is already taken.',
            'phone_taken'            => 'That phone number is already taken.',
            'cannot_change_email'    => 'You cannot change your e-mail address. This is you default notification means.',
            'cannot_change_phone'    => 'You cannot change your phone number. This is you default notification means.',
            'cannot_change_username' => 'You cannot change your username. Please contact support',
            'no_picture'             => 'You must supply a profile image.',
            
            'password' => [
                'change_mismatch'      => 'That is not your old password.',
                'reset_successful'     => 'Password reset successful',
                'reset_code_confirmed' => 'Password reset confirmed successfully. Choose a new password',
                'reset_problem'        => 'There was a problem resetting your password. Please resend the password reset email.',
                'reset_not_confirmed'  => 'There was a problem resetting your password. Please resend the password reset code.',
            ],
            'pin' => [
                'change_error' => 'There was a problem changing your pin code. Please try again later.'
            ],
            'registration_disabled' => 'Registration is currently closed.',
            'sms' => [
                'send_error' => 'Oops! Sorry we are currently facing a problem with the SMS gateway'
            ]
        ],
    ],
    'api' => [
        'auth'    => [
            'confirmation' => [
                'already_confirmed' => 'Your account is already confirmed.',
                'confirm'           => 'Confirm your account!',
                'created_confirm'   => 'Your account was successfully created. We have sent you a message to confirm your account.',
                'created_pending'   => 'Your account was successfully created and is pending approval. A message will be sent when your account is approved.',
                'mismatch'          => 'Your confirmation code does not match.',
                'not_found'         => 'That confirmation code does not exist.',
                'pending'           => 'Your account is currently pending approval.',
                'resend'            => 'Your account is not confirmed. Please click the confirmation link in your e-mail.',
                'success'           => 'Your account has been successfully confirmed!',
                'resent'            => 'A new confirmation e-mail has been sent to the address on file.',
            ],
            'deactivated' => 'Your account has been deactivated.',
            'email_taken' => 'That e-mail address is already taken.',
            'phone_taken' => 'That phone number address is already taken.',
            
            'password' => [
                'change_mismatch' => 'That is not your old password.',
                'reset_problem'   => 'There was a problem resetting your password. Please resend the password reset email.',
            ],
            'registration_disabled' => 'Registration is currently closed.',
            'login'                 => [
                'unauthorized'                     => 'You are not authorized.',
                'not_found'                        => 'The email does not exist',
                'refresh_error'                    => 'Your token could not be refreshed',
                'general_error'                    => 'There was an authorization problem',
                'require_confirmation_or_approval' => 'You can\'t log in at the moment. Your account may require approval or needs confirmation',
            ]
        ],
        'request' => [
            'bad' => [
                'too_much_attempts'   => 'You are making too many requests to our server.',
                'locale_unsupported'  => 'Unsupported language in request header \'Content-Language\'.',
                'invalid_accept'      => 'The required accept header parameter application/json is missing in your request.',
                'route_not_found'     => 'This route does not exist or you may not have permission to view it.',
                'method_not_allowed'  => 'This endpoint cannot be accessed with this method.',
                'token_expired'       => 'Your Authorization token has expired',
                'token_invalid'       => 'Your token is invalid',
                'token_error_unknown' => 'Unknown authentication error'
            ],
            'validation' => [
                'unprocessable_entity' => 'Some information provided could not be processed.'
            ],
            'general_error' => [
                'message' => 'Oops something unexpected happened!'
            ]
        ],
    ],
];
