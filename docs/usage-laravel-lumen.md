## Usage in Laravel / Lumen

**NOTE:** For `Laravel` users, this package registers itself automatically.

### Configuration

Set these values in your `.env` file

```dotenv
ONESIGNAL_API_KEY=
ONESIGNAL_AUTH_KEY=
ONESIGNAL_APP_ID=
```

### Register the service provider (lumen users only)

Add this line to your `bootstrap/app.php` file

```php
$app->register(Kodjunkie\OnesignalPhpSdk\OneSignalServiceProvider::class);

// Register the facade (optional)
// To use, must have $app->withFacades() enabled
if (!class_exists('OneSignal')) {
    class_alias(Kodjunkie\OnesignalPhpSdk\Facade::class, 'OneSignal');
}
```

### Initialize the SDK

When using this package in either of these frameworks, you have several options for instantiating the `OneSignal` class.

#### Using the Facade

With the help of facade, you can directly access each method statically

```php
$response = OneSignal::app()->getAll();
```

#### Resolve via the IoC container

```php
// Using the class
use Kodjunkie\OnesignalPhpSdk\OneSignal;

$oneSignal = app()->make(OneSignal::class);

// Or using the alias
$oneSignal = app()->make('onesignal');
```

#### Resolve via Dependency Injection

You can type hint the `OneSignal` class in any method or function, and it'll be resolved automatically for you. See the
example below

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodjunkie\OnesignalPhpSdk\OneSignal;
use Kodjunkie\OnesignalPhpSdk\Exceptions\OneSignalException;

class PodcastController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, OneSignal $oneSignal)
    {
        // Get the user
        $user = $request->user();
        // Perform your logic
        $podcast = $user->podcast()->create($request->all());
        
        try {
            // Create a notification
            $oneSignal->notification()->create([
                'include_player_ids' => [$user->player_id],
                'contents' => ['en' => $request->content],
                'headings' => ['en' => 'Podcast created'],
                'data' => ['podcastId' => $podcast->id]
            ]);
        } catch (OneSignalException $exception) {
            // Catch any unexpected error
            \Log::error($exception->getMessage());
        }
        
        return response()->json($podcast);
    }
}

```
