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
                'already_exists'    => 'Un rôle portant ce nom existe déjà.',
                'cant_delete_admin' => 'Le rôle Administrator ne peut être supprimé.',
                'create_error'      => 'Un problème est survenu lors de la création du rôle. Veuillez réessayer.',
                'delete_error'      => 'Un problème est survenu lors de la suppression du rôle. Veuillez réessayer.',
                'has_users'         => 'Ce rôle est associé à des utilisateurs et ne peut être supprimé.',
                'needs_permission'  => 'Vous devez sélectionner au moins une permission pour ce rôle.',
                'not_found'         => "Ce rôle n'existe pas.",
                'update_error'      => 'Un problème est survenu lors de la mise à jour du rôle. Veuillez réessayer.',
                'name_exists'       => 'A role already exists with the name :name.',
            ],
            'users' => [
                'already_confirmed'    => 'Le compte de cet utilisateur est déjà confirmé.',
                'cant_confirm' => "Un problème est survenu lors de la confirmation du compte de l'utilisateur.",
                'cant_deactivate_self'  => "Vous ne pouvez pas désactiver votre propre compte d'utilisateur.",
                'cant_delete_admin'  => "Vous ne pouvez pas supprimer le compte d'utilisateur du super administrateur.",
                'cant_delete_self'      => "Vous ne pouvez pas supprimer votre propre compte d'utilisateur.",
                'cant_delete_own_session' => 'Vous ne pouvez pas supprimer votre propre session.',
                'cant_restore'          => "Cet utilisateur n'est pas effacé et ne peut être restauré.",
                'cant_unconfirm_admin' => "Vous ne pouvez pas infirmer le compte d'utilisateur du super administrateur.",
                'cant_unconfirm_self' => "Vous ne pouvez pas infirmer votre propre compte d'utilisateur.",
                'create_error'          => "Un problème est survenu lors de la création de l'utilisateur. Veuillez réessayer.",
                'delete_error'          => "Un problème est survenu lors de la suppression de l'utilisateur. Veuillez réessayer.",
                'delete_first'          => "Cet utilisateur doit d'abord être supprimé avant de pouvoir être supprimé de façon permanente.",
                'username_error'          => 'That username belongs to a different user.',
                'email_error'           => 'Cette adresse email appartient à un autre utilisateur.',
                'phone_error'             => 'That phone number belongs to a different user.',
                'mark_error'            => "Un problème est survenu lors de la mise à jour de l'utilisateur. Veuillez réessayer.",
                'not_confirmed'         => "Le compte de cet utilisateur n'est pas confirmé.",
                'not_found'             => "Cet utilisateur n'existe pas.",
                'restore_error'         => "Un problème est survenu lors de la restauration de l'utilisateur. Veuillez réessayer.",
                'role_needed_create'    => 'Vous devez sélectionner au moins un rôle.',
                'role_needed'           => 'Vous devez sélectionner au moins un rôle.',
                'session_wrong_driver'  => 'Votre pilote de session doit être configuré avec une base de données pour utiliser cette fonctionalité.',
                'social_delete_error' => "Un problème est survenu lors de la suppression du compte de réseau social de l'utilisateur.",
                'update_error'          => "Un problème est survenu lors de la mise à jour de l'utilisateur. Veuillez réessayer.",
                'transfer_error'          => 'There was a problem transferring this user. Please try again.',
                'update_password_error' => "Un problème est survenu lors du changement du mot de passe de l'utilisateur. Veuillez réessayer.",
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
                'login_error'           => 'There was a problem logging into this company. Please try again.',
                'inactive'              => 'There was a problem processing the request. This company is inactive',
            ],
            'service' => [
                'mark_error'   => 'There was a problem updating the status of this service for this company. Please try again.',
                'update_error' => 'There was a problem updating the this service for this company. Please try again.',
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
            ],
            'commission' => [
                'create_error'     => 'There was a problem creating this commission. Please try again.',
                'update_error'     => 'There was a problem updating this commission. Please try again.',
                'invalid_pricings' => 'The :attribute contain some invalid values',
            ],
            'method'     => [
                'create_error' => 'There was a problem creating this payment method. Please try again.',
                'update_error' => 'There was a problem updating this payment method. Please try again.',
                'mark_error'   => 'There was a problem updating the status of this payment method. Please try again.',
            ],
            'category' => [
                'update_error' => 'There was a problem updating this category. Please try again.',
                'mark_error'   => 'There was a problem updating the status of this category. Please try again.',
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
                'already_confirmed' => 'Votre compte est déjà confirmé.',
                'confirm'           => 'Confirmez votre compte !',
                'created_confirm'   => 'Votre compte a été créé avec succès.  Un message de confirmation vous a été envoyé.',
                'created_pending'   => 'Votre compte a été créé avec succès et est en attente de validation. Un message vous sera envoyé quand votre compte sera validé.',
                'mismatch'          => 'Votre code de confirmation est invalide.',
                'not_found'         => "Votre code de confirmation n'existe pas.",
                'pending'            => 'Votre compte est actuellement en attente de validation.',
                'resend'            => 'Votre compte n\'est pas confirmé. Veuillez utiliser le lien qui vous a été envoyé par email, ou <a href=":url">cliquez ici </a> pour recevoir un nouvel email.',
                'confirm_pending'      => 'Please confirm your account. Enter the code sent to :account, or <a href=":url">click here</a> to resend the code.',
                'success'           => 'Votre compte est maintenant confirmé !',
                'resent'            => "Un nouvel email a été envoyé à l'adresse enregistrée.",
                'code_resent'          => 'A new confirmation code has been sent to :account. <a href=":url">Resend</a>',
                'code_reset_resent'    => 'A new password reset code has been sent to :account. <a href=":url">Resend</a>',
                'code_reset_not_found' => 'The password reset code does not exist',
                'no_company'           => 'You have a business account which is not linked to any company at the moment.',
                'deactivated_company'  => 'You have a business account and your company has been deactivated. Please contact your company administrator.',
            ],
            'deactivated' => 'Votre compte a été désactivé.',
            'email_taken' => 'Cet email est déjà utilisé par un compte existant.',
            'phone_taken'            => 'That phone number is already taken.',
            'cannot_change_email'    => 'You cannot change your e-mail address. This is you default notification means.',
            'cannot_change_phone'    => 'You cannot change your phone number. This is you default notification means.',
            'cannot_change_username' => 'You cannot change your username. Please contact support',
            'no_picture'             => 'You must supply a profile image.',

            'password' => [
                'change_mismatch' => "L'ancien mot de passe est incorrect.",
                'reset_successful'     => 'Password reset successful',
                'reset_code_confirmed' => 'Password reset confirmed successfully. Choose a new password',
                'reset_problem' => 'Un problème est survenu lors de la réinitialisation de votre mot de passe. Veuillez renvoyer l\'e-mail de réinitialisation du mot de passe.',
                'reset_not_confirmed'  => 'There was a problem resetting your password. Please resend the password reset code.',
            ],
            'pin' => [
                'change_error' => 'There was a problem changing your pin code. Please try again later.'
            ],
            'registration_disabled' => 'L\'inscription est actuellement indisponible.',
        ],
    ],
    'api' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Votre compte est déjà confirmé.',
                'confirm'           => 'Confirmez votre compte !',
                'created_confirm'   => 'Votre compte a été créé avec succès.  Un message de confirmation vous a été envoyé.',
                'created_pending'   => 'Votre compte a été créé avec succès et est en attente de validation. Un message vous sera envoyé quand votre compte sera validé.',
                'mismatch'          => 'Votre code de confirmation est invalide.',
                'not_found'         => "Votre code de confirmation n'existe pas.",
                'pending'            => 'Votre compte est actuellement en attente de validation.',
                'resend'            => 'Votre compte n\'est pas confirmé. Veuillez utiliser le lien qui vous a été envoyé par email, ou <a href=":url">cliquez ici </a> pour recevoir un nouvel email.',
                'success'           => 'Votre compte est maintenant confirmé !',
                'resent'            => "Un nouvel email a été envoyé à l'adresse enregistrée.",
            ],
            'deactivated' => 'Votre compte a été désactivé.',
            'email_taken' => 'Cet email est déjà utilisé par un compte existant.',
            'phone_taken' => 'That phone number address is already taken.',

            'password' => [
                'change_mismatch' => "L'ancien mot de passe est incorrect.",
                'reset_problem' => 'Un problème est survenu lors de la réinitialisation de votre mot de passe. Veuillez renvoyer l\'e-mail de réinitialisation du mot de passe.',
            ],
            'registration_disabled' => 'L\'inscription est actuellement indisponible.',
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
                'locale_unsupported' => 'Langue du contenu dans l\'en-tête de la demande non prise en charge \'Content-Language\'',
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
