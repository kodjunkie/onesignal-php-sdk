<?php

namespace Kodjunkie\OnesignalPhpSdk;

/**
 * @method static \Kodjunkie\OnesignalPhpSdk\Endpoints\App app()
 * @method static \Kodjunkie\OnesignalPhpSdk\Endpoints\Device device()
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
