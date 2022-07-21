<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Endpoints\App;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Notification;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Segment;

class OneSignal extends Service
{
    /**
     * App API
     * @return App
     * @throws Exceptions\OneSignalException
     */
    public function app(): App
    {
        return $this->build(App::class);
    }

    /**
     * Device API
     * @return Device
     * @throws Exceptions\OneSignalException
     */
    public function device(): Device
    {
        return $this->build(Device::class);
    }

    /**
     * Notification API
     * @return Notification
     * @throws Exceptions\OneSignalException
     */
    public function notification(): Notification
    {
        return $this->build(Notification::class);
    }

    /**
     * Segment API
     * @return Segment
     * @throws Exceptions\OneSignalException
     */
    public function segment(): Segment
    {
        return $this->build(Segment::class);
    }
}
