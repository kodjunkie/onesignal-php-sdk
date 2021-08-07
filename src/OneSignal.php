<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Endpoints\App;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;

class OneSignal extends Service
{
    /**
     * Apps API
     * @return App
     */
    public function apps(): App
    {
        return $this->build('app');
    }

    /**
     * Device API
     * @return Device
     */
    public function devices(): Device
    {
        return $this->build('device');
    }
}