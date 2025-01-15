<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-ulQNealwh0-6meP4Do04xTgC'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-qxA7e0wpu9hUGyhk'),
    'environment' => env('MIDTRANS_ENV', 'sandbox'),
    'is_production' => false,
    'is_sanitized' => true,
    'is_3ds' => true,
    'redirect_url' => env('APP_URL') . '/dashboard/history',
    'finish_redirect_url' => env('APP_URL') . '/dashboard/history',
];
