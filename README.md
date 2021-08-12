<h1 align="center">OneSignal PHP SDK</h1>

<div align="center">

OneSignal SDK for PHP developers with fluent API and supports Laravel / Lumen out of the box.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kodjunkie/onesignal-php-sdk.svg)](https://packagist.org/packages/kodjunkie/onesignal-php-sdk) [![tests](https://github.com/kodjunkie/onesignal-php-sdk/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/kodjunkie/onesignal-php-sdk/actions/workflows/php.yml) <a href="https://github.com/kodjunkie/onesignal-php-sdk/blob/master/LICENSE"><img src="https://img.shields.io/badge/license-MIT-red.svg" alt="license: MIT" height="20"></a>

</div>

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
use Kodjunkie\OnesignalPhpSdk\Exceptions\OneSignalException;

try {
    $config = [
        // Onesignal API key
        'api_key' => '',
        // Onesignal Auth key
        'auth_key' => '',
        // Onesignal App ID (optional)
        // Providing your app_id is beneficial if you're working with a single OneSignal app
        // and don't want to provide it all the time for endpoints that requires it
        'app_id' => '',
    ];
    
    // Initialize the SDK
    $oneSignal = new OneSignal($config);
    
    // Using the API
    // Get all apps
    $response = $oneSignal->app()->getAll();
    
    // You can use json_decode to get the response as an stdClass Object
    var_dump($response);
} catch (OneSignalException $exception) {
    var_dump($exception->getMessage());
}
```

### Usage in Laravel / Lumen

Set these values in your `.env` file

```dotenv
ONESIGNAL_API_KEY=
ONESIGNAL_AUTH_KEY=
ONESIGNAL_APP_ID=
```

### Register the service provider (lumen users only)

Add this line to your `bootstrap/app.php` file

```php
$app->register(\Kodjunkie\OnesignalPhpSdk\OneSignalServiceProvider::class);
```

Lastly, use in your `controller` or wherever it's needed

```php
use Kodjunkie\OnesignalPhpSdk\OneSignal;
use Kodjunkie\OnesignalPhpSdk\Exceptions\OneSignalException;

try {
    // Initialize the SDK
    // Resolve from the IoC container
    $oneSignal = app()->make('onesignal');
    
    // Using the API
    // Get all devices
    $response = $oneSignal->device()->getAll($appId, $limit, $offset);
    
    // Using Facade, the code above will look like this
    // With app_id provided in the config
    $response = OneSignal::device()->getAll(null, $limit, $offset);
    
    dd($response);
} catch (OneSignalException $exception) {
    dd($exception->getMessage());
}
```

## Tests

```bash
composer test
```

## License

This project is opened under the [MIT 2.0 License](https://github.com/kodjunkie/onesignal-php-sdk/blob/master/LICENSE)
which allows very broad use for both academic and commercial purposes.
