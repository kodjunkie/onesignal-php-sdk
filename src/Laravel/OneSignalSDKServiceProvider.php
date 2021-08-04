<?php

namespace Kodjunkie\OnesignalPhpSdk\Laravel;

use Illuminate\Support\ServiceProvider;
use Kodjunkie\OnesignalPhpSdk\OneSignal;

/**
 * Class OneSignalServiceProvider.
 */
class OneSignalSDKServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->registerBindings();
    }

    /**
     * Setup the configuration.
     */
    protected function configure()
    {
        if ($this->app instanceof \Illuminate\Foundation\Application) {
            $this->publishes([
                __DIR__ . '/config.php' => config_path('onesignal.php')
            ], 'config');
        } elseif ($this->app instanceof \Laravel\Lumen\Application) {
            $this->app->configure('onesignal');
        }
    }

    /**
     * Register bindings in the container.
     */
    protected function registerBindings()
    {
        $this->app->alias(OneSignal::class, 'onesignal');

        $this->app->singleton('onesignal', function () {
            return new OneSignal(config('onesignal'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [OneSignal::class, 'onesignal'];
    }
}