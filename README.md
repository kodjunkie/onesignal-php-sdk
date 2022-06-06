<h1 align="center">OneSignal PHP SDK</h1>

<div align="center">

OneSignal SDK for PHP developers with fluent API and supports Laravel / Lumen out of the box.

[![Latest Stable Version](http://poser.pugx.org/kodjunkie/onesignal-php-sdk/v)](https://packagist.org/packages/kodjunkie/onesignal-php-sdk) [![Total Downloads](http://poser.pugx.org/kodjunkie/onesignal-php-sdk/downloads)](https://packagist.org/packages/kodjunkie/onesignal-php-sdk) [![PHP Version Require](http://poser.pugx.org/kodjunkie/onesignal-php-sdk/require/php)](https://packagist.org/packages/kodjunkie/onesignal-php-sdk) [![tests](https://github.com/kodjunkie/onesignal-php-sdk/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/kodjunkie/onesignal-php-sdk/actions/workflows/php.yml) <a href="https://github.com/kodjunkie/onesignal-php-sdk/blob/master/LICENSE"><img src="https://img.shields.io/badge/license-MIT-red.svg" alt="license: MIT" height="20"></a>

</div>

- How to use this package? [Click here](https://github.com/kodjunkie/onesignal-php-sdk/tree/master/docs)
- For official documentation [click here](https://documentation.onesignal.com/reference)

## Why use this package?

> This is the only package out there that is unambiguous to set up, and has a fluent / straightforward API.

## Installation

**NOTE:** For `Laravel` users, this package registers itself automatically.

```bash
composer require kodjunkie/onesignal-php-sdk
```

### Usage in plain PHP

```php
use Kodjunkie\OnesignalPhpSdk\OneSignal;
use Kodjunkie\OnesignalPhpSdk\Exceptions\OneSignalException;

$config = [
        // Onesignal API key
        'api_key' => '',
        // Onesignal Auth key
        'auth_key' => '',
        // Onesignal App ID (optional)
        // this is beneficial if you're working with a single OneSignal app
        // so, you could pass "null" to methods that requires it.
        'app_id' => '',
    ];

try {
    // Initialize the SDK
    $oneSignal = new OneSignal($config);
    
    // Using the API
    // Get all apps
    $response = $oneSignal->app()->getAll();
    
    // Use json_decode() to get the response as an stdClass object
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

#### Register the service provider (lumen only)

Add this line below to your `bootstrap/app.php` file

```php
$app->register(\Kodjunkie\OnesignalPhpSdk\OneSignalServiceProvider::class);

// Register the facade (optional)
// To use, must have $app->withFacades() enabled
if (!class_exists('OneSignal')) {
    class_alias(\Kodjunkie\OnesignalPhpSdk\Facade::class, 'OneSignal');
}
```

#### Code samples

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
