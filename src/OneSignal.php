<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Clients\GuzzleHttpClient;
use Kodjunkie\OnesignalPhpSdk\Api\App;

class OneSignal
{
    /**
     * @var string
     */
    private $config;

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
        $Classname = "\\Kodjunkie\\OnesignalPhpSdk\\Api\\" . ucfirst($classname);
        return new $Classname(new GuzzleHttpClient(), $this->config);
    }
}