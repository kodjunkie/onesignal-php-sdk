# API Reference

Using this package in a laravel / lumen
project? [Click for more examples](https://github.com/kodjunkie/onesignal-php-sdk/blob/master/docs/usage-laravel-lumen.md)

## OneSignal PHP SDK

**See**: https://documentation.onesignal.com/reference

* [$config](#configuration) ⇒ <code>array</code>
* [new OneSignal($config)](#new_OneSignal_object)
    * _instance_
        * [->app()](#app+getAll) ⇒ <code>App::class</code>
            * [->getAll()](#app+getAll) ⇒ <code>JSON</code>
            * [->get(string $appId = null)](#app+get) ⇒ <code>JSON</code>
            * [->create(array $body)](#app+create) ⇒ <code>JSON</code>
            * [->update(array $body, string $appId = null)](#app+update) ⇒ <code>JSON</code>
            * [->outcomes(string $appId = null, array $params = [])](#app+outcomes) ⇒ <code>JSON</code>
            * [->updateTags(array $tags, string $externalUserId, string $appId = null)](#app+updateTags) ⇒ <code>
              JSON</code>
        * [->device()](#device+object) ⇒ <code>Device::class</code>
            * [->getAll(string $appId = null, int $limit = 300, int $offset = 0)](#device+getAll) ⇒ <code>JSON</code>
            * [->get(string $playerId, string $appId = null, string $emailAuthHash = null)](#device+get) ⇒ <code>
              JSON</code>
            * [->create(array $body)](#device+create) ⇒ <code>JSON</code>
            * [->update(string $playerId, array $body)](#device+update) ⇒ <code>JSON</code>
            * [->delete(string $playerId, string $appId = null)](#device+delete) ⇒ <code>JSON</code>
            * [->export(string $appId = null, array $body = [])](#device+export) ⇒ <code>JSON</code>
        * [->notification()](#notification+object) ⇒ <code>Notification::class</code>
            * [->getAll(string $appId = null, int $limit = 50, int $offset = 0, int $kind = null)](#notification+getAll)
              ⇒ <code>JSON</code>
            * [->get(string $notificationId, string $appId = null)](#notification+getAll) ⇒ <code>JSON</code>
            * [->create(array $body)](#notification+create) ⇒ <code>JSON</code>
            * [->cancel(string $notificationId, string $appId = null)](#notification+cancel) ⇒ <code>JSON</code>
            * [->history(string $notificationId, string $email, string $event, string $appId = null)](#notification+history)
              ⇒ <code>JSON</code>
        * [->segment()](#segment+object) ⇒ <code>Segment::class</code>
            * [->create(array $body, string $appId = null)](#segment+create) ⇒ <code>JSON</code>
            * [->delete(string $segmentId, string $appId = null)](#segment+delete) ⇒ <code>JSON</code>

### Configuration

**NOTE:** Providing your `app_id` is beneficial if, you're working with a single `OneSignal` app and don't want to
provide it as argument to methods that requires it; the examples below assume you have it set.

```php
$config = [
    // Onesignal API Key
    'api_key' => '',
    // Onesignal Auth Key
    'auth_key' => '',
    // Onesignal App ID (optional)
    'app_id' => '',
];
```

<a name="new_OneSignal_object"></a>

### Initialize the SDK

```php
use Kodjunkie\OnesignalPhpSdk\OneSignal;

$oneSignal = new OneSignal($config);
```

<a name="app+getAll"></a>

### View all apps

See: [https://documentation.onesignal.com/reference/view-apps-apps](https://documentation.onesignal.com/reference/view-apps-apps)

```php
$response = $oneSignal->app()->getAll();
```

<a name="app+get"></a>

### View an app

See: [https://documentation.onesignal.com/reference/view-an-app](https://documentation.onesignal.com/reference/view-an-app)

```php
// Optionally: You can use with an empty argument
// To get the details for the app you provided in the config
$response = $oneSignal->app()->get();

// To get the details for a different app
// or when no "app_id" is provided in the config
// then pass the "app_id" as an argument
$response = $oneSignal->app()->get($appId);
```

<a name="app+create"></a>

### Create a new app

See: [https://documentation.onesignal.com/reference/create-an-app](https://documentation.onesignal.com/reference/create-an-app)

```php
$response = $oneSignal->app()->create([
    'name' => 'Demo App'
]);
```

<a name="app+update"></a>

### Update an app

See: [https://documentation.onesignal.com/reference/update-an-app](https://documentation.onesignal.com/reference/update-an-app)

```php
$response = $oneSignal->app()->update([
    'name' => 'Updated Demo App',
    'apns_env' => 'production'
]);
```

<a name="app+outcomes"></a>

### View app outcomes

See: [https://documentation.onesignal.com/reference/view-outcomes](https://documentation.onesignal.com/reference/view-outcomes)

```php
$response = $oneSignal->app()->outcomes(null, [
    'outcome_names' => ['os__session_duration.count', 'os__click.count']
]);
```

<a name="app+updateTags"></a>

### Edit tags with external user id

See: [https://documentation.onesignal.com/reference/edit-tags-with-external-user-id](https://documentation.onesignal.com/reference/edit-tags-with-external-user-id)

```php
$response = $oneSignal->app()->updateTags([
    'country_code' => "NG",
    'state' => "F.C.T"
], $externalUserId);
```

<a name="device+getAll"></a>

### View all devices

See: [https://documentation.onesignal.com/reference/view-devices](https://documentation.onesignal.com/reference/view-devices)

```php
$response = $oneSignal->device()->getAll(null, $limit);
```

<a name="device+get"></a>

### View a device

See: [https://documentation.onesignal.com/reference/view-device](https://documentation.onesignal.com/reference/view-device)

```php
$response = $oneSignal->device()->get($playerId);
```

<a name="device+create"></a>

### Create a new device

See: [https://documentation.onesignal.com/reference/add-a-device](https://documentation.onesignal.com/reference/add-a-device)

```php
use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;

$response = $oneSignal->device()->create([
    'app_id' => '', // optional if already provided in the config
    'device_type' => Device::IOS,
    'country' => 'US',
    'tags' => [
        'full_name' => 'John Doe'
    ]
]);
```

<a name="device+update"></a>

### Update a device

See: [https://documentation.onesignal.com/reference/edit-device](https://documentation.onesignal.com/reference/edit-device)

```php
$response = $oneSignal->device()->update($playerId, [
    'app_id' => '', // optional if already provided in the config
    'country' => 'NG',
    'tags' => [
        'full_name' => 'Jane Doe'
    ]
]);
```

<a name="device+delete"></a>

### Delete a device / user

See: [https://documentation.onesignal.com/reference/delete-user-record](https://documentation.onesignal.com/reference/delete-user-record)

```php
$response = $oneSignal->device()->delete($playerId);
```

<a name="device+export"></a>

### Export all of your current device data in CSV

See: [https://documentation.onesignal.com/reference/csv-export](https://documentation.onesignal.com/reference/csv-export)

```php
$response = $oneSignal->device()->export(null, [
    'extra_fields' => [
        "country", "notification_types", "external_user_id", "location", "ip", "country"
    ],
    'last_active_since' => '1469392779',
    'segment_name' => 'Subscribed Users'
]);
```

<a name="notification+getAll"></a>

### View all notifications

See: [https://documentation.onesignal.com/reference/view-notifications](https://documentation.onesignal.com/reference/view-notifications)

```php
$response = $oneSignal->notification()->getAll(null, $limit);
```

> To view API only notifications

```php
use Kodjunkie\OnesignalPhpSdk\Endpoints\Notification;

$response = $oneSignal->notification()->getAll(null, $limit, $offset, Notification::API_ONLY);
```

<a name="notification+get"></a>

### View a notification

See: [https://documentation.onesignal.com/reference/view-notification](https://documentation.onesignal.com/reference/view-notification)

```php
$response = $oneSignal->notification()->get($notificationId);
```

<a name="notification+create"></a>

### Create a new notification

See: [https://documentation.onesignal.com/reference/create-notification](https://documentation.onesignal.com/reference/create-notification)

```php
$response = $oneSignal->notification()->create([
    'app_id' => '', // optional if already provided in the config
    'include_player_ids' => [$playerId],
    'contents' => ['en' => 'Thank you for subscribing.'],
    'headings' => ['en' => 'Subscription success'],
    'data' => ['extra' => 'Some extra details']
]);
```

<a name="notification+cancel"></a>

### Cancel a notification

See: [https://documentation.onesignal.com/reference/cancel-notification](https://documentation.onesignal.com/reference/cancel-notification)

```php
$response = $oneSignal->notification()->cancel($notificationId);
```

<a name="notification+history"></a>

### View notification history

See: [https://documentation.onesignal.com/reference/notification-history](https://documentation.onesignal.com/reference/notification-history)

```php
use Kodjunkie\OnesignalPhpSdk\Endpoints\Notification;

$response = $oneSignal->notification()->history($notificationId, $email, Notification::CLICKED_EVENT);
```

<a name="segment+create"></a>

### Create a new segment

See: [https://documentation.onesignal.com/reference/create-segments](https://documentation.onesignal.com/reference/create-segments)

```php
$response = $oneSignal->segment()->create([
    "name" => "Demo Segment",
    "filters" => [
        ["field" => "session_count", "relation" => ">", "value" => "1"],
        ["operator" => "AND"],
        ["field" => "tag", "relation" => "!=", "key" => "tag_key", "value" => "1"],
        ["operator" => "OR"],
        ["field" => "last_session", "relation" => "<", "hours_ago" => "30"]
    ]
]);
```

<a name="segment+delete"></a>

### Delete a segment

See: [https://documentation.onesignal.com/reference/delete-segments](https://documentation.onesignal.com/reference/delete-segments)

```php
$response = $oneSignal->segment()->delete($segmentId);
```
