# API Reference

Using this package in a laravel / lumen project? [click for more examples](https://github.com/kodjunkie/onesignal-php-sdk/blob/master/docs/usage-laravel-lumen.md)

## OneSignal PHP SDK

**See**: https://documentation.onesignal.com/reference

* [$config](#configuration) ⇒ <code>array</code>
* [new OneSignal($config)](#new_OneSignal_object)
    * _instance_
        * [->app()](#app+object) ⇒ <code>App::class</code>
            * [->getAll()](#app+getAll) ⇒ <code>JSON</code>
            * [->get(string $appId = null)](#app+get) ⇒ <code>JSON</code>
            * [->create(array $body)](#app+create) ⇒ <code>JSON</code>
            * [->update(array $body, string $appId = null)](#app+update) ⇒ <code>JSON</code>
            * [->outcomes(string $appId = null, array $params = [])](#app+outcomes) ⇒ <code>JSON</code>
            * [->updateTags(array $tags, string $external_user_id, string $appId = null)](#app+updateTags) ⇒ <code>
              JSON</code>
        * [->device()](#device+object) ⇒ <code>Device::class</code>
            * [->getAll(string $appId = null, int $limit = 300, int $offset = 0)](#device+getAll) ⇒ <code>JSON</code>
            * [->get(string $playerId, string $appId = null, string $email_auth_hash = null)](#device+get) ⇒ <code>
              JSON</code>
            * [->create(array $body)](#device+create) ⇒ <code>JSON</code>
            * [->update(string $playerId, array $body)](#device+update) ⇒ <code>JSON</code>
            * [->delete(string $playerId, string $appId = null)](#device+delete) ⇒ <code>JSON</code>
            * [->export(string $appId = null, array $body = [])](#device+export) ⇒ <code>JSON</code>
        * [->notification()](#notification+object) ⇒ <code>Notification::class</code>
            * [->getAll(string $appId = null, int $limit = 50, int $offset = 0, int $kind = null)](#notification+getAll) ⇒ <code>JSON</code>
            * [->get(string $notificationId, string $appId = null)](#notification+getAll) ⇒ <code>JSON</code>
            * [->create(array $body)](#notification+create) ⇒ <code>JSON</code>
            * [->cancel(string $notificationId, string $appId = null)](#notification+cancel) ⇒ <code>JSON</code>
            * [->history(string $notificationId, string $email, string $events, string $appId = null)](#notification+history) ⇒ <code>JSON</code>
        * [->segment()](#segment+object) ⇒ <code>Segment::class</code>
            * [->create(array $body, string $appId = null)](#segment+create) ⇒ <code>JSON</code>
            * [->delete(string $segmentId, string $appId = null)](#segment+delete) ⇒ <code>JSON</code>

### Configuration

```php
    $config = [
        'app_id' => '', // Onesignal App ID
        'api_key' => '', // Onesignal API key
        'auth_key' => '' // Onesignal Auth key
    ];
```

<a name="new_OneSignal_object"></a>

### Initialize the SDK

```php
    use Kodjunkie\OnesignalPhpSdk\OneSignal;

    $oneSignal = new OneSignal($config);
```
