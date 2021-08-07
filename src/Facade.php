<?php

namespace Kodjunkie\OnesignalPhpSdk;

/**
 * @method static OneSignal apps()
 * @method static void addMessage(mixed $message, string $label = 'info')
 *
 * @see OneSignal
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return OneSignal::class;
    }
}
