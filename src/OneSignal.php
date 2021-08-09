<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Endpoints\App;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;

class OneSignal extends Service
{
    /**
     * App API
     * @return App
     * @throws Exceptions\OneSignalException
     */
    public function app(): App
    {
        return $this->build('app');
    }

    /**
     * Device API
     * @return Device
     * @throws Exceptions\OneSignalException
     */
    public function device(): Device
    {
        return $this->build('device');
    }
}