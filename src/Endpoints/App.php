<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Clients\HttpClient;

class App extends Base
{
    /**
     * Get all apps
     * @return string
     */
    public function getAll(): string
    {
        return $this->client()->get('apps');
    }

    /**
     * Get an app
     * @param string $appId
     * @return string
     */
    public function get(string $appId): string
    {
        return $this->client()->get('apps/' . $appId);
    }

    /**
     * Create a new app
     * @param array $params
     * @return string
     */
    public function create(array $params = []): string
    {
        return $this->client()->post('apps', $params);
    }

    /**
     * Get app outcomes
     * @param string $appId
     * @param array $params
     * @return string
     */
    public function outcomes(string $appId, array $params = []): string
    {
        return $this->client->setAuthKey($this->config['api_key'])
            ->get("apps/${appId}/outcomes", $params);
    }

    /**
     * @return HttpClient
     */
    public function client(): HttpClient
    {
        return $this->client->setAuthKey($this->config['auth_key']);
    }
}
