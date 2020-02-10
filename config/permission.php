<?php

return [

    'models' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    /*
     * By default all permissions will be cached for 24 hours unless a permission or
     * role is updated. Then the cache will be flushed immediately.
     */

    'cache_expiration_time' => 60 * 24,

    /*
     * By default we'll make an entry in the application log when the permissions
     * could not be loaded. Normally this only occurs while installing the packages.
     *
     * If for some reason you want to disable that logging, set this value to false.
     */

    'log_registration_exception' => true,
    
    
    /*
     * Business Permissions
     */

    'permissions' => [
    
        'view_backend' => 'view backend',
    
        // companies
        'create_companies'     => 'create companies',
        'read_companies'       => 'read companies',
        'update_companies'     => 'update companies',
        'delete_companies'     => 'delete companies',
        'deactivate_companies' => 'deactivate companies',
        
        // company service
        'deactivate_company_services' => 'deactivate company services',
        'update_company_services' => 'update company services',
        'create_company_services' => 'create company services',
        'read_company_services' => 'read company services',
        
        // commissions
        'create_commissions'     => 'create commissions',
        'read_commissions'       => 'read commissions',
        'update_commissions'     => 'update commissions',
        'delete_commissions'     => 'delete commissions',
    
        // services
        'create_services'      => 'create services',
        'read_services'        => 'read services',
        'update_services'      => 'update services',
        'delete_services'      => 'delete services',
        'deactivate_services'  => 'deactivate services',
    
        // users
        'create_users'         => 'create users',
        'read_users'           => 'read users',
        'update_users'         => 'update users',
        'delete_users'         => 'delete users',
        'deactivate_users'     => 'deactivate users',
        'transfer_users'       => 'transfer users',
        
        // accounts
        'float_accounts'       => 'float accounts',
        
        'debit_accounts'       => 'debit accounts',
        'credit_accounts'      => 'credit accounts',
        'freeze_accounts'      => 'freeze accounts',
        
        'request_payouts'      => 'request payouts',
        'validate_payouts'     => 'validate payouts',
        
        'transfer_money'       => 'Transfer Money'
    ],

];
