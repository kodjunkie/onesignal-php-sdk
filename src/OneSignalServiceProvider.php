<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Illuminate\Support\ServiceProvider;

/**
 * Class OneSignalServiceProvider.
 */
class OneSignalServiceProvider extends ServiceProvider
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
     * Set up the configuration.
     */
    protected function configure()
    {
        if ($this->app instanceof \Illuminate\Foundation\Application) {
            $this->publishes([
                __DIR__ . '../../config/onesignal.php' => config_path('onesignal.php')
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
        $this->app->singleton(OneSignal::class, function () {
            return new OneSignal(config('onesignal'));
        });

        $this->app->alias(OneSignal::class, 'onesignal');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [OneSignal::class, 'onesignal'];
    }
}