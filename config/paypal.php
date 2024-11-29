<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Puede ser 'sandbox' o 'live'

    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        'app_id'        => env('PAYPAL_SANDBOX_APP_ID'),
    ],

    'live' => [
        'client_id'     => env('PAYPAL_LIVE_CLIENT_ID'),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET'),
        'app_id'        => env('PAYPAL_LIVE_APP_ID'),
    ],

    'payment_action' => 'Sale', // Puedes ajustar esto si necesitas "Authorization"
    'currency'       => 'MXN',
    'notify_url'     => '', // URL para notificaciones IPN
    'locale'         => 'es_MX',
    'validate_ssl'   => true, // Cambiar a false si tienes problemas en entornos locales con SSL
];