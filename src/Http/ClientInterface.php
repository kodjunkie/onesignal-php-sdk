<?php

namespace Kodjunkie\OnesignalPhpSdk\Http;

interface ClientInterface
{
    /**
     * @return string
     */
    public function getAuthKey(): string;

    /**
     * @param string $authKey
     */
    public function setAuthKey(string $authKey): ClientInterface;

    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    public function get(string $url, array $params = []): string;

    /**
     * @param string $url
     * @param array $data
     * @return string
     */
    public function put(string $url, array $data = []): string;

    /**
     * @param string $url
     * @param array $data
     * @return string
     */
    public function post(string $url, array $data = []): string;

    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    public function delete(string $url, array $params = []): string;
}
