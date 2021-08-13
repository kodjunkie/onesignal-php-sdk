<?php

namespace Kodjunkie\OnesignalPhpSdk\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Kodjunkie\OnesignalPhpSdk\Exceptions\OneSignalException;

class GuzzleHttpClient implements ClientInterface
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
     * @return ClientInterface
     */
    public function setAuthKey(string $authKey): ClientInterface
    {
        $this->authKey = $authKey;
        return $this;
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     * @throws OneSignalException
     */
    public function get(string $url, array $params = []): string
    {
        return $this->request('GET', $url, ['query' => $params]);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $params
     * @return string
     * @throws OneSignalException
     */
    public function post(string $url, array $data, array $params = []): string
    {
        return $this->request('POST', $url, [
            'json' => $data,
            'query' => $params
        ]);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $params
     * @return string
     * @throws OneSignalException
     */
    public function put(string $url, array $data, array $params = []): string
    {
        return $this->request('PUT', $url, [
            'json' => $data,
            'query' => $params
        ]);
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     * @throws OneSignalException
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
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "Basic " . $this->getAuthKey(),
            ]
        ]);
    }

    /**
     * Build the request
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return string
     * @throws OneSignalException
     */
    private function request(string $method, string $uri, array $options = []): string
    {
        try {
            $response = $this->client()->request($method, $uri, $options);
            $response = $response->getBody()->getContents();
        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
        } catch (GuzzleException $exception) {
            throw new OneSignalException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $response;
    }
}
