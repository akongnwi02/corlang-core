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
                'already_exists'    => 'Un rôle existe déjà à ce nom. Veuillez choisir un autre nom.',
                'cant_delete_admin' => 'Vous ne pouvez pas supprimer le rôle d\'administrateur.',
                'create_error'      => 'Une erreur est survenue lors de la création du rôle. Veuillez réessayer.',
                'delete_error'      => 'Une erreur est survenue lors de la suppression du rôle. Veuillez réessayer.',
                'has_users'         => 'Vous ne pouvez pas supprimer un rôle lorsque des utilisateurs sont associés.',
                'needs_permission'  => 'Vous devez choisir au moins une autorisation pour ce rôle.',
                'not_found'         => "Ce rôle n'existe pas.",
                'update_error'      => 'Une erreur est survenue lors de la mise à jour du rôle. Veuillez réessayer.',
                'name_exists'       => 'Un rôle existe déjà avec le nom : nom.',
            ],
            'users' => [
                'already_confirmed'    => 'Le compte de cet utilisateur est déjà confirmé.',
                'cant_confirm' => "Une erreur est survenue lors de la confirmation du compte de l'utilisateur.",
                'cant_deactivate_self'  => "Vous ne pouvez pas désactiver votre compte d'utilisateur.",
                'cant_delete_admin'  => "Vous ne pouvez pas supprimer le compte d'utilisateur du super administrateur.",
                'cant_delete_self'      => "Vous ne pouvez pas supprimer votre compte d'utilisateur.",
                'cant_delete_own_session' => 'Vous ne pouvez pas supprimer votre session.',
                'cant_restore'          => "Cet utilisateur n'est pas supprimé et ne peut donc pas être restauré.",
                'cant_unconfirm_admin' => "Vous ne pouvez pas infirmer le compte d'utilisateur du super administrateur.",
                'cant_unconfirm_self' => "Vous ne pouvez pas infirmer votre compte d'utilisateur.",
                'create_error'          => "Une erreur est survenue lors de la création de l'utilisateur. Veuillez réessayer.",
                'delete_error'          => "Une erreur est survenue lors de la suppression de l'utilisateur. Veuillez réessayer.",
                'delete_first'          => "Cet utilisateur doit d'abord être supprimé avant de pouvoir être définitivement éliminé.",
                'username_error'          => 'Ce nom d\'utilisateur appartient à un autre utilisateur.',
                'email_error'           => 'Cette adresse email appartient à un autre utilisateur.',
                'phone_error'             => 'Ce numéro de téléphone appartient à un autre utilisateur.',
                'mark_error'            => "Une erreur est survenue lors de la mise à jour de l'utilisateur. Veuillez réessayer.",
                'not_confirmed'         => "Le compte de cet utilisateur n'est pas confirmé.",
                'not_found'             => "Cet utilisateur n'existe pas.",
                'restore_error'         => "Une erreur  est survenue lors de la restauration de l'utilisateur. Veuillez réessayer.",
                'role_needed_create'    => 'Vous devez sélectionner au moins un rôle.',
                'role_needed'           => 'Vous devez sélectionner au moins un rôle.',
                'session_wrong_driver'  => 'Votre pilote de session doit être configuré avec une base de données pour utiliser cette fonctionalité.',
                'social_delete_error' => "Une erreur est survenue lors de la suppression du compte de réseau social de l'utilisateur.",
                'update_error'          => "Une erreur est survenue lors de la mise à jour de l'utilisateur. Veuillez réessayer.",
                'transfer_error'          => 'Une erreur est survenue lors du transfert de cet utilisateur. Veuillez réessayer..',
                'update_password_error' => "Une erreur est survenue lors du changement du mot de passe de l'utilisateur. Veuillez réessayer.",
                'reset_pin_error'         => 'Une erreur est survenue lors de la réinitialisation du code pin de cet utilisateur. Veuillez réessayer.',
                'reset_topup_account_error'         => 'Une erreur est survenue lors de la réinitialisation des comptes de recharge de cet utilisateur. Veuillez réessayer.',
            ],
        ],
        'companies' => [
            'company' => [
                'create_error'          => 'Une erreur est survenue lors de la création de cette entreprise. Veuillez réessayer.',
                'update_error'          => 'Une erreur est survenue lors de la mise à jour de cette entreprise. Veuillez réessayer.',
                'mark_error'            => 'Une erreur est survenue lors de la mise à jour du statut de cette entreprise. Veuillez réessayer.',
                'mark_rights_error'     => 'Une erreur est survenue lors de la mise à jour du statut de cette entreprise. L\'entreprise a été désactivée par un rôle supérieur.',
                'cant_change_attribute' => 'Vous n\'êtes pas autorisé à modifier l\'attribut',
                'cant_change_check_box' => 'Vous n\'êtes pas autorisé à modifier l\'une des valeurs des cases à cocher',
                'invalid_service'       => 'Un service non valide a été fourni',
                'login_error'           => 'Une erreur est survenue lors de la connexion de cette entreprise. Veuillez réessaye.',
                'inactive'              => 'Une erreur est survenue lors du traitement de la requête. Cette entreprise est inactive',
            ],
            'service' => [
                'mark_error'   => 'Une erreur est survenue lors de la mise à jour du statut de ce service pour cette entreprise. Veuillez réessayer.',
                'update_error' => 'Une erreur est survenue lors de la mise à jour du service pour cette entreprise. Veuillez réessayer.',
            ]
        ],
        'account' => [
            'mark_error'              => 'Une erreur est survenue lors du blocage de ce compte.',
            'inactive'                => 'Une erreur est survenue lors de l\'autorisation du service. Le compte est inactif.',
            'insufficient_balance'    => 'Une erreur est survenue lors de l\'autorisation du service. Le solde est insuffisant',
            'insufficient_drain'      => 'Solde insuffisant dans le compte espèce',
            'insufficient_commission' => 'Solde insuffisant dans le compte commissions',
        ],
        'accounting' => [
            'insufficient_provision_amount' => 'La valeur est supérieure au montant de la commission',
            'insufficient_collected_amount' => 'La valeur est supérieure au montant collectcé',
            'provision_request_error' => 'Une erreur est survenue lors de la demande de provision. Veuillez réessayer.',
            'collection_payment_error' => 'Une erreur est survenue lors du paiement de la collecte. Veuillez réessayer.'
        ],
        'movement' => [
            'create_error' => 'Une erreur est survenue lors de l\'exécution de cette transaction. Veuillez réessayer.',
        ],
        'services' => [
            'service'    => [
                'create_error'  => 'Une erreur est survenue lors de la création de ce service. Veuillez réessayer.',
                'update_error'  => 'Une erreur est survenue lors de la mise à jour de ce service. Veuillez réessayer.',
                'mark_error'    => 'Une erreur est survenue lors de la mise à jour du statut de ce service. Veuillez réessayer.',
                'invalid_items' => 'La valeur contient des données non valides.',
            ],
            'commission' => [
                'create_error'     => 'Une erreur est survenue lors de la création de cette commission. Veuillez réessayer.',
                'update_error'     => 'Une erreur est survenue lors de la mise à jour de cette commission. Veuillez réessayer.',
                'invalid_pricings' => 'La valeur contient des données non valides',
            ],
            'method'     => [
                'create_error' => 'Une erreur est survenue lors de la création de ce mode de paiement. Veuillez réessayer.',
                'update_error' => 'Une erreur est survenue lors de la mise à jour de ce mode de paiement. Veuillez réessayer.',
                'mark_error'   => 'Une erreur est survenue lors de la mise à jour du statut de ce mode de paiement. Veuillez réessayer.',
            ],
            'category' => [
                'update_error' => 'Une erreur est survenue lors de la mise à jour de cette rubrique. Veuillez réessayer.',
                'mark_error'   => 'Une erreur est survenue lors de la mise à jour du statut de cette rubrique. Veuillez réessayer.',
            ]
        ],
        'payout'   => [
            'drain_error'      => 'There was an error draining the amount',
            'transfer_error'   => 'Une erreur est survenue lors du transfert du montant dans le strongbox.',
            'payout_error'     => 'Une erreur est survenue lors de l\'exécution du paiement. Veuillez réessayer.',
            'no_company_error' => 'L\'utilisateur n\'appartient à aucune entreprise',
            'invalid_status'   => 'Le statut de paiement n\'est pas valide.',
            'status_error'     => 'Une erreur est survenue lors de la mise à jour du statut de paiement. Veuillez réessayer.',
            'state_error'     => 'Une erreur est survenue lors de la mise à jour du statut de paiement. Le paiement est dans un état définitif..'
        ]
    ],
    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Votre compte est déjà confirmé.',
                'confirm'           => 'Confirmez votre compte !',
                'created_confirm'   => 'Votre compte a été créé avec succès.  Un message de confirmation vous a été envoyé.',
                'created_pending'   => 'Votre compte a été créé avec succès et est en attente de validation. Un message vous sera envoyé une fois votre compte validé.',
                'mismatch'          => 'Votre code de confirmation n\'est pas valide.',
                'not_found'         => "Ce code de confirmation n'existe pas.",
                'pending'            => 'Votre compte est actuellement en attente de validation.',
                'resend'            => 'Votre compte n\'est pas confirmé. Veuillez utiliser le lien qui vous a été envoyé par email, ou <a href=":url">cliquez ici </a> pour recevoir un nouvel email.',
                'confirm_pending'      => 'Veuillez confirmer votre compte. Entrez le code envoyé au :account, ou <a href=":url">cliquez ici</a> pour renvoyer le code.',
                'success'           => 'Votre compte est maintenant confirmé !',
                'resent'            => "Un nouvel email a été envoyé à l'adresse enregistrée.",
                'code_resent'          => 'Un nouveau code de confirmation a été envoyé à :account. <a href=":url">Resend</a>',
                'code_reset_resent'    => 'Un nouveau code de réinitialisation du mot de passe a été envoyé à :account. <a href=":url">Resend</a>',
                'code_reset_not_found' => 'Le code de réinitialisation du mot de passe n\'existe pas',
                'no_company'           => 'Vous avez un compte professionel qui n\'est lié à aucune entreprise pour le moment.',
                'deactivated_company'  => 'Vous avez un compte professionnel et votre entreprise a été désactivée . Veuillez contacter votre administrateur.',
            ],
            'deactivated' => 'Votre compte a été désactivé.',
            'email_taken' => 'Cette adresse email est déjà utilisé par un autre utilisateur.',
            'phone_taken'            => 'Ce  numéro de téléphone est déjà utilisé par un autre utilisateur.',
            'cannot_change_email'    => 'Vous ne pouvez pas changer votre adresse email. C\'est la signification de votre notification par défaut.',
            'cannot_change_phone'    => 'Vous ne pouvez pas changer votre numéro de téléphone. C\'est la signification de votre notification par défaut.',
            'cannot_change_username' => 'Vous ne pouvez pas changer votre nom d\'utilisateur. Veuillez contacter le support',
            'no_picture'             => 'Vous devez ajouter une photo de profil.',

            'password' => [
                'change_mismatch' => "L'ancien mot de passe n'est pas correct.",
                'reset_successful'     => 'Le mot de passe a été réinitialisé avec succès',
                'reset_code_confirmed' => 'La réinitialisation du mot de passe a été confirmée avec succès. Veuillez choisir un nouveau mot de passe',
                'reset_problem' => 'Une erreur est survenue lors de la réinitialisation de votre mot de passe. Veuillez renvoyer l\'e-mail de réinitialisation du mot de passe.',
                'reset_not_confirmed'  => 'Une erreur est survenue lors de la réinitialisation de votre mot de passe. Veuillez renvoyer le code de réinitialisation du mot de passe.',
            ],
            'pin' => [
                'change_error' => 'Une erreur est survenue lors du changement de votre code pin. Veuillez réessayer plus tard.'
            ],
            'registration_disabled' => 'L\'inscription est actuellement fermée.',
        ],
    ],
    'api' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Votre compte est déjà confirmé.',
                'confirm'           => 'Confirmez votre compte !',
                'created_confirm'   => 'Votre compte a été créé avec succès.  Un message de confirmation vous a été envoyé.',
                'created_pending'   => 'Votre compte a été créé avec succès et est en attente de validation. Un message vous sera envoyé une fois votre compte validé.',
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
                'unauthorized'                     => 'Vous n\'êtes pas autorisé.',
                'not_found'                        => 'L\'émail n\'existe pas',
                'refresh_error'                    => 'Votre code n\'a pas pu être actualisé.',
                'general_error'                    => 'Un problème d\'autorisation est survenu',
                'require_confirmation_or_approval' => 'Vous ne pouvez pas vous connecter pour le moment. Votre compte pourrait être soumis à approbation ou nécessiter une confirmation',
            ]
        ],
        'request' => [
            'bad' => [
                'too_much_attempts'   => 'Vous adressez trop de demandes à notre serveur.',
                'locale_unsupported' => 'Langue non prise en charge dans l\'en-tête de la requête \'Content-Language\'',
                'invalid_accept'      => 'Le paramètre obligatoire d\'acceptation d\'application/json est absent de votre demande.',
                'route_not_found'     => 'Cette route n\'existe pas ou vous n\'avez peut-être pas l\'autorisation de la consulter.',
                'method_not_allowed'  => 'Ce terminal n\'est pas accessible par cette méthode.',
                'token_expired'       => 'Votre code de validation a expiré',
                'token_invalid'       => 'Votre code n\'est pas valide',
                'token_error_unknown' => 'Erreur d\'authentification inconnue'
            ],
            'validation' => [
                'unprocessable_entity' => 'Certaines informations fournies n\'ont pas pu être traitées.'
            ],
            'general_error' => [
                'message' => 'Oups, un événement inattendu s\'est produit!'
            ]
        ],
    ],
];
