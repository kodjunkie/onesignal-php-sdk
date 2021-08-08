<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;

class Device extends Base
{
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

    /**
     * @return ClientInterface
     */
    private function client(): ClientInterface
    {
        return $this->client->setAuthKey($this->config['api_key']);
    }
}
