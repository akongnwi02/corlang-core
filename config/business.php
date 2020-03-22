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
    
    'payout' => [
        'type' => [
            'commission' => 'commission',
            'drain' => 'drain',
        ],
        'status' => [
            'pending' => 'pending',
            'approved' => 'approved',
            'rejected' => 'rejected',
            'cancelled' => 'cancelled',
        ],
    ],
    'service' => [
        'category' => [
            'prepaidbills' => [
                'name' => 'Prepaid Bills',
                'code' => 'CORPREPAID001',
                'api_key' => env(''),
                'api_url' => env(''),
            ]
        ]
    ],
    
    'system' => [
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
            'name' => 'Corlang',
            'description' => 'Pay with your Corlang account'
        ]
    ],
    'transaction' => [
        'status' => [
            'pending' => 'pending',
            'successful' => 'successful',
            'failed'  => 'failed',
        ],
    ]
];
