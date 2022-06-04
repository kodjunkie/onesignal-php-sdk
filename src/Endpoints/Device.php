<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidArgumentException;

class Device extends AbstractBase
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
     * @param string|null $appId
     * @param int $limit
     * @param int $offset
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/view-devices
     */
    public function getAll(string $appId = null, int $limit = 300, int $offset = 0): string
    {
        return $this->client()->get('players', [
            'app_id' => $this->getAppId($appId),
            'limit' => $limit,
            'offset' => $offset
        ]);
    }

    /**
     * Get a device
     * @param string $playerId
     * @param string|null $appId
     * @param string|null $emailAuthHash
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/view-device
     */
    public function get(string $playerId, string $appId = null, string $emailAuthHash = null): string
    {
        $path = is_null($emailAuthHash) ? $playerId : $playerId . '/' . $emailAuthHash;
        return $this->client()->get('players/' . $path, ['app_id' => $this->getAppId($appId)]);
    }

    /**
     * Create a new device
     * @param array $body
     * @return string
     * @see https://documentation.onesignal.com/reference/add-a-device
     * @throws InvalidArgumentException
     */
    public function create(array $body): string
    {
        return $this->client()->post('players', array_merge([
            'app_id' => $this->getAppId()
        ], $body));
    }

    /**
     * Edit a device
     * @param string $playerId
     * @param array $body
     * @return string
     * https://documentation.onesignal.com/reference/edit-device
     * @throws InvalidArgumentException
     */
    public function update(string $playerId, array $body): string
    {
        return $this->client()->put('players/' . $playerId, array_merge([
            'app_id' => $this->getAppId()
        ], $body));
    }

    /**
     * Delete a device
     * @param string $playerId
     * @param string|null $appId
     * @return string
     * https://documentation.onesignal.com/reference/delete-user-record
     * @throws InvalidArgumentException
     */
    public function delete(string $playerId, string $appId = null): string
    {
        return $this->client()->delete('players/' . $playerId, ['app_id' => $this->getAppId($appId)]);
    }

    /**
     * Export device data in CSV
     * @param string|null $appId
     * @param array $body
     * @return string
     * https://documentation.onesignal.com/reference/csv-export
     * @throws InvalidArgumentException
     */
    public function export(string $appId = null, array $body = []): string
    {
        return $this->client()->post('players/csv_export', $body, ['app_id' => $this->getAppId($appId)]);
    }
}
