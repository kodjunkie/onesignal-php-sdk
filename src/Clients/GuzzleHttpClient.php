<?php

namespace Kodjunkie\OnesignalPhpSdk\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Kodjunkie\OnesignalPhpSdk\OneSignalSDKException;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient implements HttpClient
{
    /**
     * @var string
     */
    private $authKey;

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return HttpClient
     */
    public function setAuthKey(string $authKey): HttpClient
    {
        $this->authKey = $authKey;
        return $this;
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     * @throws OneSignalSDKException
     */
    public function get(string $url, array $params = []): string
    {
        return $this->request('GET', $url, ['query' => $params]);
    }

    /**
     * @param string $url
     * @param array $data
     * @return string
     * @throws OneSignalSDKException
     */
    public function post(string $url, array $data = []): string
    {
        return $this->request('POST', $url, ['json' => $data]);
    }

    /**
     * @param string $url
     * @param array $data
     * @return string
     * @throws OneSignalSDKException
     */
    public function put(string $url, array $data = []): string
    {
        return $this->request('PUT', $url, ['json' => $data]);
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     * @throws OneSignalSDKException
     */
    public function delete(string $url, array $params = []): string
    {
        return $this->request('DELETE', $url, ['query' => $params]);
    }

    /**
     * Initialize the client
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
     * Build the request
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return string
     * @throws OneSignalSDKException
     */
    private function request(string $method, string $uri, array $options = []): string
    {
        try {
            $response = $this->client()->request($method, $uri, $options);
            $response = $response->getBody()->getContents();
        } catch (GuzzleException $exception) {
            $response = null;
            if ($exception instanceof RequestExceptionInterface) {
                $response = $exception->getResponse();
            }

            if ($response instanceof ResponseInterface) {
                throw new OneSignalSDKException($exception->getMessage(), $exception->getCode(), $exception);
            }
        }

        return $response;
    }
}