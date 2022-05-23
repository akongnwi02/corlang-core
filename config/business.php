<?php

return [

    'company' => [
        'type' => [
            'internal' => 'internal',
            'merchant' => 'merchant',
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
            'provision'  => 'provision',
            'collection' => 'collection',
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
            'prepaidbills'  => [
                'code' => 'CORPREPAID001',
            ],
            'receivemoney'  => [
                'code' => 'CORRECEIVEMONEY001',
            ],
            'sendmoney'     => [
                'code' => 'CORSENDMONEY001',
            ],
            'postpaidbills' => [
                'code' => 'CORPOSTPAID001',
            ],
            'airtime' => [
                'code' => 'CORAIRTIME001',
            ],
            'data' => [
                'code' => 'CORDATA001',
            ],
        ],
        'endpoints' => [
            'search'  => '/search',
            'execute' => '/execute',
            'status'  => '/status',
            'balance' => '/balance',
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
            'merchant' => [
                'process' => 'process_order'
            ]
        ],
    ],
];
