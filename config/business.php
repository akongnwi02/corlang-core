<?php

return [
    
    'company' => [
        'type' => [
            'formal'   => 'informal company',
            'informal' => 'informal company',
        ]
    ],
    
    'account' => [
        'type' => [
            'user'    => 'user account',
            'company' => 'company account',
        ]
    ],
    
    'movement' => [
        'type' => [
            'sale'       => 'sale',
            'purchase'   => 'purchase',
            'deposit'    => 'deposit',
            'withdrawal' => 'withdrawal',
            'float'      => 'float',
        ]
    ],
    
    'payout'      => [
        'type'   => [
            'commission' => 'commission',
            'drain'      => 'drain',
        ],
        'status' => [
            'pending'   => 'pending',
            'approved'  => 'approved',
            'rejected'  => 'rejected',
            'cancelled' => 'cancelled',
        ],
    ],
    'service'     => [
        'category'  => [
            'prepaidbills' => [
                'name'    => 'Prepaid Bills',
                'code'    => 'CORPREPAID001',
                'api_url' => env('APP_CATEGORY_PREPAID_BILL_URL'),
                'api_key' => env('APP_CATEGORY_PREPAID_BILL_KEY'),
            ],
            'mobilemoney'  => [
                'name'    => 'Mobile Money',
                'code'    => 'COREMOMO',
                'api_url' => env('APP_CATEGORY_MOBILE_MONEY_URL'),
                'api_key' => env('APP_CATEGORY_MOBILE_MONEY_KEY'),
            ]
        ],
        'endpoints' => [
            'search'  => '/search',
            'execute' => '/execute',
            'status' => '/status',
        ]
    ],
    'system'      => [
        'country' => [
            'name' => [
                'cameroon' => 'cameroon',
            ],
            'code' => [
                'cameroon' => 'CM'
            ]
        ],
        'setting' => [
            'key' => [
            ]
        ],
        'service' => [
            'name'        => 'Corlang',
            'description' => 'Pay with your Corlang account'
        ]
    ],
    'transaction' => [
        'status' => [
            'pending'      => 'pending',
            'failed'       => 'failed',
            'created'      => 'created',
            'processing'   => 'processing',
            'success'      => 'success',
            'errored'      => 'errored',
            'reversed'     => 'reversed',
            'verification' => 'verification',
        ],
        'queue'  => [
            'purchase' => [
                'process'  => 'process_purchase',
                'verify'   => 'verify_purchase',
                'complete' => 'complete_purchase',
            ],
        ],
    ],
];
