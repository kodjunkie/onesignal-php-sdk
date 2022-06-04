<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidArgumentException;

class Segment extends AbstractBase
{
    /**
     * Create a new segment
     * @param array $body
     * @param string|null $appId
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/create-segments
     */
    public function create(array $body, string $appId = null): string
    {
        return $this->client()->post('apps/' . $this->getAppId($appId) . '/segments', $body);
    }

    /**
     * Delete a segment
     * @param string $segmentId
     * @param string|null $appId
     * @return string
     * @throws InvalidArgumentException
     * @see https://documentation.onesignal.com/reference/delete-segments
     */
    public function delete(string $segmentId, string $appId = null): string
    {
        return $this->client()->delete('apps/' . $this->getAppId($appId) . '/segments/' . $segmentId);
    }

}
