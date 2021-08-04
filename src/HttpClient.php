<?php

namespace Kodjunkie\OnesignalPhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\ResponseInterface;

abstract class HttpClient
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Initialize client
     * @return Client
     */
    private function client(): Client
    {
        return new Client([
            'base_uri' => 'https://onesignal.com/api/v1/',
            'timeout' => 30,
            'headers' => [
                "Content-Type" => "application/json; charset=utf-8",
                "Authorization" => "Basic " . $this->getAuthKey()
            ]
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return string
     * @throws OneSignalSDKException
     */
    public function request(string $method, string $uri, array $options = []): string
    {
        try {
            $response = $this->client()->request($method, $uri, $options);
            $response = $response->getBody()->getContents();
        } catch (GuzzleException $exception) {
            $response = null;
            if ($exception instanceof RequestExceptionInterface) {
                $response = $exception->getResponse();
            }

            if (!($response instanceof ResponseInterface)) {
                throw new OneSignalSDKException($exception->getMessage(), $exception->getCode(), $exception);
            }
        }

        return $response;
    }

    /**
     * @return string
     */
    abstract protected function getAuthKey(): string;
}
