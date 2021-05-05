<?php

return [
    'jobs' => [
         'apple' => [
             'INITIAL_BUY' => App\Jobs\PaymentNotifications\HandleInitialBuy::class,
             'DID_RENEW' => App\Jobs\PaymentNotifications\HandleRenewal::class,
             'DID_FAIL_TO_RENEW' => App\Jobs\PaymentNotifications\HandleFailRenewal::class,
             'CANCEL' => App\Jobs\PaymentNotifications\HandleCancellation::class,
         ]

    ],
    'method' => [
        'apple' => 'createFromAppleRequest',
    ]
];
