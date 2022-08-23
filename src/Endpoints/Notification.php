<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidArgumentException;

class Notification extends Endpoint
{
    // Notification Kinds
    const DASHBOARD_ONLY = 0;
    const API_ONLY = 1;
    const AUTOMATED_ONLY = 3;

    // Event Types
    const SENT_EVENT = 'sent';
    const CLICKED_EVENT = 'clicked';

    /**
     * View all notifications
     * @param string|null $appId
     * @param int $limit
     * @param int $offset
     * @param int|null $kind
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/view-notifications
     */
    public function getAll(string $appId = null, int $limit = 50, int $offset = 0, int $kind = null): string
    {
        $kindArr = is_null($kind) ? [] : ['kind' => $kind];
        return $this->client()->get('notifications', array_merge([
            'app_id' => $this->getAppId($appId),
            'limit' => $limit,
            'offset' => $offset
        ], $kindArr));
    }

    /**
     * Get a notification
     * @param string $notificationId
     * @param string|null $appId
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/view-notification
     */
    public function get(string $notificationId, string $appId = null): string
    {
        return $this->client()->get('notifications/' . $notificationId, ['app_id' => $this->getAppId($appId)]);
    }

    /**
     * Create a new notification
     * @param array $body
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/create-notification
     */
    public function create(array $body): string
    {
        return $this->client()->post('notifications', array_merge([
            'app_id' => $this->getAppId()
        ], $body));
    }

    /**
     * Cancel a notification
     * @param string $notificationId
     * @param string|null $appId
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/cancel-notification
     */
    public function cancel(string $notificationId, string $appId = null): string
    {
        return $this->client()->delete('notifications/' . $notificationId, ['app_id' => $this->getAppId($appId)]);
    }

    /**
     * View notification history
     * @param string $notificationId
     * @param string $email
     * @param string $event
     * @param string|null $appId
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/notification-history
     */
    public function history(string $notificationId, string $email, string $event, string $appId = null): string
    {
        return $this->client()->post('notifications/' . $notificationId . '/history', [
            'app_id' => $this->getAppId($appId),
            'email' => $email,
            'events' => $event
        ]);
    }
}
