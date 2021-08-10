<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidArgumentException;
use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;

class App extends Base
{
    /**
     * View all apps
     * @return string
     * @url https://documentation.onesignal.com/reference/view-apps-apps
     */
    public function getAll(): string
    {
        return $this->client()->get('apps');
    }

    /**
     * View an app
     * @param string|null $appId
     * @return string
     * @url https://documentation.onesignal.com/reference/view-an-app
     * @throws InvalidArgumentException
     */
    public function get(string $appId = null): string
    {
        return $this->client()->get('apps/' . $this->getAppId($appId));
    }

    /**
     * Create a new app
     * @param array $body
     * @return string
     * @url https://documentation.onesignal.com/reference/create-an-app
     */
    public function create(array $body): string
    {
        return $this->client()->post('apps', $body);
    }

    /**
     * Update an app
     * @param array $body
     * @param string|null $appId
     * @return string
     * @throws InvalidArgumentException
     * @url https://documentation.onesignal.com/reference/update-an-app
     */
    public function update(array $body, string $appId = null): string
    {
        return $this->client()->put('apps/' . $this->getAppId($appId), $body);
    }

    /**
     * View the outcome of an app
     * @param string|null $appId
     * @param array $params
     * @return string
     * @throws InvalidArgumentException
     * @url https://documentation.onesignal.com/reference/view-outcomes
     */
    public function outcomes(string $appId = null, array $params = []): string
    {
        return $this->client->setAuthKey($this->config['api_key'])
            ->get('apps/' . $this->getAppId($appId) . '/outcomes', $params);
    }

    /**
     * Update an existing device's tags using the External User ID.
     * @param array $tags
     * @param string $external_user_id
     * @param string|null $appId
     * @return string
     * @url https://documentation.onesignal.com/reference/edit-tags-with-external-user-id
     * @throws InvalidArgumentException
     */
    public function updateTags(array $tags, string $external_user_id, string $appId = null): string
    {
        return $this->client()->put('apps/' . $this->getAppId($appId) . '/users/' . $external_user_id, [
            'tags' => $tags
        ]);
    }

    /**
     * @return ClientInterface
     */
    public function client(): ClientInterface
    {
        return $this->client->setAuthKey($this->config['auth_key']);
    }
}
