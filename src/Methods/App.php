<?php

namespace Kodjunkie\OnesignalPhpSdk\Methods;

use Kodjunkie\OnesignalPhpSdk\HttpClient;
use Kodjunkie\OnesignalPhpSdk\OneSignalSDKException;

class App extends HttpClient
{
    /**
     * Get all apps
     * @return string
     * @throws OneSignalSDKException
     */
    public function getAll(): string
    {
        return $this->request('GET', 'apps');
    }

    /**
     * Get an app
     * @param $appID
     * @return string
     * @throws OneSignalSDKException
     */
    public function get($appID): string
    {
        return $this->request('GET', 'apps/' . $appID);
    }

    /**
     * Create a new app
     * @param array $params
     * @return string
     * @throws OneSignalSDKException
     */
    public function create(array $params = []): string
    {
        return $this->request('POST', 'apps', ['json' => $params]);
    }

    /**
     * @return string
     */
    protected function getAuthKey(): string
    {
        return $this->config['auth_key'];
    }

}
