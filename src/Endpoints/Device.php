<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidArgumentException;

class Device extends Endpoint
{
    // Device Type Constants
    const IOS = 0;
    const ANDROID = 1;
    const AMAZON = 2;
    const WINDOWSPHONE = 3;
    const CHROMEAPPS = 4;
    const CHROMEWEBPUSH = 5;
    const WINDOWS = 6;
    const SAFARI = 7;
    const FIREFOX = 8;
    const MACOS = 9;
    const ALEXA = 10;
    const EMAIL = 11;
    const HUAWEI = 13;
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
    public function getAll(string $appId = null, int $limit = 100, int $offset = 0): string
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
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/add-a-device
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
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/edit-device
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
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/delete-user-record
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
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/csv-export
     */
    public function export(string $appId = null, array $body = []): string
    {
        return $this->client()->post('players/csv_export', $body, ['app_id' => $this->getAppId($appId)]);
    }
}
