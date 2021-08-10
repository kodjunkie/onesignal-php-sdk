<?php

return [
    // Onesignal API key
    'api_key' => env('ONESIGNAL_API_KEY'),
    // Onesignal Auth key
    'auth_key' => env('ONESIGNAL_AUTH_KEY'),
    // Onesignal App ID (optional)
    // Providing your app_id is only beneficial if you're working with a single OneSignal app
    // and don't want to provide it all the time for endpoints that requires it.
    'app_id' => env('ONESIGNAL_APP_ID'),
];
