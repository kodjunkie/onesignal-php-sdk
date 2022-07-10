<?php

return [
    // Onesignal API Key
    'api_key' => env('ONESIGNAL_API_KEY'),
    // Onesignal Auth Key
    'auth_key' => env('ONESIGNAL_AUTH_KEY'),
    // Onesignal App ID (optional)
    // this is beneficial if you're working with a single OneSignal app
    // so, you could pass "null" to methods / functions that requires it.
    'app_id' => env('ONESIGNAL_APP_ID'),
];
