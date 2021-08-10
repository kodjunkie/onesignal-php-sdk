## OneSignal PHP SDK

**NOTE:** For `Laravel` users, this package registers itself automatically.

### Setup in Laravel / Lumen

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

### Instantiating the object

When using this package in either of these frameworks, you have several options for instantiating the `OneSignal` class.

#### Using the Facade

With the help of facade, you can directly access each method statically from the `OneSignal` class

```php
use Kodjunkie\OnesignalPhpSdk\OneSignal;

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

You can type hint the `OneSignal` class in any method or function, and it'll be resolved automatically for you.

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
    public function subscribe(Request $request, OneSignal $oneSignal)
    {
        try {
            // Get the user
            $user = $request->user();
            
            // Perform your logic
            
            // Create a notification
            $response = $oneSignal->notification()->create([
                        'include_player_ids' => [$user->player_id],
                        'contents' => ['en' => 'Thank you for subscribing.'],
                        'headings' => ['en' => 'Subscription success'],
                        'data' => ['extra' => 'Some extra details']
                    ]);

            return response()->json($response);
        } catch (OneSignalException $exception) {
            \Log::error($exception->getMessage());
        }
    }
}

```
