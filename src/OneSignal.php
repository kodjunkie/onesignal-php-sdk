<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Methods\App;

class OneSignal
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Apps API
     * @return App
     */
    public function apps(): App
    {
        return $this->make('app');
    }

    /**
     * @param $classname
     * @return mixed
     */
    public function make($classname)
    {
        $Class = "\\Kodjunkie\\OnesignalPhpSdk\\Methods\\" . ucfirst($classname);
        return new $Class($this->config);
    }
}