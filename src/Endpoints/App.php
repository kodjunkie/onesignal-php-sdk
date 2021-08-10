<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

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
     * @param string $appId
     * @return string
     * @url https://documentation.onesignal.com/reference/view-an-app
     */
    public function get(string $appId): string
    {
        return $this->client()->get('apps/' . $appId);
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
     * @param string $appId
     * @param array $body
     * @return string
     * @url https://documentation.onesignal.com/reference/update-an-app
     */
    public function update(string $appId, array $body): string
    {
        return $this->client()->put('apps/' . $appId, $body);
    }

    /**
     * View the outcome of an app
     * @param string $appId
     * @param array $params
     * @return string
     * @url https://documentation.onesignal.com/reference/view-outcomes
     */
    public function outcomes(string $appId, array $params = []): string
    {
        return $this->client->setAuthKey($this->config['api_key'])
            ->get("apps/${appId}/outcomes", $params);
    }

    /**
     * Update an existing device's tags using the External User ID.
     * @param string $appId
     * @param string $external_user_id
     * @param array $tags
     * @return string
     * @url https://documentation.onesignal.com/reference/edit-tags-with-external-user-id
     */
    public function updateTags(string $appId, string $external_user_id, array $tags): string
    {
        return $this->client()->put('apps/' . $appId . '/users/' . $external_user_id, [
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
