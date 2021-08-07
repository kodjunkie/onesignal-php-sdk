# OneSignal PHP SDK

OneSignal SDK for PHP developers with fluent APIs and supports Laravel / Lumen out of the box.

- How to use this package? [Click here](https://github.com/kodjunkie/onesignal-php-sdk/tree/master/docs)
- For Official documentation [click here](https://documentation.onesignal.com/reference)

## Installation

```bash
composer require kodjunkie/onesignal-php-sdk
```

**NOTE:** For `Laravel` users, this package registers itself automatically.

### Usage in plain PHP

```php
use Kodjunkie\OnesignalPhpSdk\OneSignal;
use Kodjunkie\OnesignalPhpSdk\OneSignalException;

try {
    $config = [
        'app_id' => '', // Onesignal App ID
        'api_key' => '', // Onesignal API key
        'auth_key' => '' // Onesignal Auth key
    ];
    
    // Initialize the SDK
    $oneSignal = new OneSignal($config);
    
    // Using the API
    // Get all apps
    $response = $oneSignal->apps()->getAll();
    
    // You can use json_decode() to get the response as an stdClass Object
    var_dump($response);
} catch (OneSignalException $exception) {
    var_dump($exception->getMessage());
}
```

### Usage in Laravel / Lumen

After requiring this package, in your terminal run

```bash
php artisan vendor:publish --provider="Kodjunkie\OnesignalPhpSdk\OneSignalServiceProvider"
```

Then set these values in your `.env` file

```dotenv
ONESIGNAL_APP_ID=
ONESIGNAL_API_KEY=
ONESIGNAL_AUTH_KEY=
```

Lastly, use in your `controller` or wherever it's needed

```php
use Kodjunkie\OnesignalPhpSdk\OneSignal;
use Kodjunkie\OnesignalPhpSdk\OneSignalException;

try {
    // Initialize the SDK
    // Using dependency injection
    $oneSignal = app()->make('onesignal');
    
    // Using the API
    // Get all devices
    $response = $oneSignal->devices()->getAll($appId, $limit, $offset);
    
    // Using facade, the code above will look like this
    $response = OneSignal::devices()->getAll($appId, $limit, $offset);
    
    dd($response);
} catch (OneSignalException $exception) {
    dd($exception->getMessage());
}
```

## License

This project is opened under the [MIT 2.0 License](https://github.com/kodjunkie/onesignal-php-sdk/blob/master/LICENSE)
which allows very broad use for both academic and commercial purposes.
