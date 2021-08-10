<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Endpoints\App;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Notification;

class OneSignal extends AbstractService
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

    /**
     * Notification API
     * @return Notification
     * @throws Exceptions\OneSignalException
     */
    public function notification(): Notification
    {
        return $this->build('notification');
    }
}
