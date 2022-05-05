<?php

return [
    // Onesignal API key
    'api_key' => env('ONESIGNAL_API_KEY'),
    // Onesignal Auth key
    'auth_key' => env('ONESIGNAL_AUTH_KEY'),
    // Onesignal App ID (optional)
    // this is beneficial if you're working with a single OneSignal app
    // so, you could pass "null" to methods that requires it.
    'app_id' => env('ONESIGNAL_APP_ID', null),
];
