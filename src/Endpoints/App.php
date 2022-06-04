<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidArgumentException;
use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;

class App extends AbstractBase
{
    /**
     * View all apps
     * @return string
     * @see https://documentation.onesignal.com/reference/view-apps-apps
     */
    public function getAll(): string
    {
        return $this->client()->get('apps');
    }

    /**
     * View an app
     * @param string|null $appId
     * @return string
     * @see https://documentation.onesignal.com/reference/view-an-app
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
     * @see https://documentation.onesignal.com/reference/create-an-app
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
     * @see https://documentation.onesignal.com/reference/update-an-app
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
     * @see https://documentation.onesignal.com/reference/view-outcomes
     */
    public function outcomes(string $appId = null, array $params = []): string
    {
        return parent::client()->get('apps/' . $this->getAppId($appId) . '/outcomes', $params);
    }

    /**
     * Update an existing device's tags using the External User ID.
     * @param array $tags
     * @param string $externalUserId
     * @param string|null $appId
     * @return string
     * @see https://documentation.onesignal.com/reference/edit-tags-with-external-user-id
     * @throws InvalidArgumentException
     */
    public function updateTags(array $tags, string $externalUserId, string $appId = null): string
    {
        return $this->client()->put('apps/' . $this->getAppId($appId) . '/users/' . $externalUserId, [
            'tags' => $tags
        ]);
    }

    /**
     * @return ClientInterface
     */
    protected function client(): ClientInterface
    {
        return $this->client->setAuthKey($this->config['auth_key']);
    }
}
