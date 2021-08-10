<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;

class Device extends Base
{
    const IOS = 0;
    const Android = 1;
    const Amazon = 2;
    const WindowsPhone = 3;
    const ChromeApps = 4;
    const ChromeWebPush = 5;
    const Windows = 6;
    const Safari = 7;
    const Firefox = 8;
    const MacOS = 9;
    const Alexa = 10;
    const Email = 11;
    const Huawei = 13;
    const SMS = 14;

    /**
     * Get all devices
     * @param string $appId
     * @param int $limit
     * @param int $offset
     * @return string
     */
    public function getAll(string $appId, int $limit = 300, int $offset = 0): string
    {
        return $this->client()->get('players', [
            'app_id' => $appId,
            'limit' => $limit,
            'offset' => $offset
        ]);
    }

    /**
     * Get a device
     * @param string $playerId
     * @param string $appId
     * @return string
     */
    public function get(string $playerId, string $appId): string
    {
        return $this->client()->get('apps/' . $playerId, ['app_id' => $appId]);
    }

    /**
     * Create a new device
     * @param array $params
     * @return string
     */
    public function create(array $params = []): string
    {
        return $this->client()->post('players', $params);
    }

    /**
     * Edit a device
     * @param string $id
     * @param array $params
     * @return string
     */
    public function edit(string $id, array $params): string
    {
        return $this->client()->put('players/' . $id, $params);
    }
}
