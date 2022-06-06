<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidConfigurationException;
use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidEndpointException;
use Kodjunkie\OnesignalPhpSdk\Http\GuzzleHttpClient;

abstract class AbstractService
{
    /**
     * @var string
     */
    private $config;

    /**
     * @param array $config
     * @throws InvalidConfigurationException
     */
    final public function __construct(array $config = [])
    {
        $apiKey = array_key_exists('api_key', $config) ? $config['api_key'] : null;
        $authKey = array_key_exists('auth_key', $config) ? $config['auth_key'] : null;

        if (!$apiKey || !$authKey)
            throw new InvalidConfigurationException('Missing required credentials [api_key and/or auth_key].');

        $this->config = $config;
    }

    /**
     * Resolve the endpoint
     * @param $endpoint
     * @return mixed
     * @throws InvalidEndpointException
     */
    final protected function build($endpoint)
    {
        $Endpoint = "\\Kodjunkie\\OnesignalPhpSdk\\Endpoints\\" . ucfirst($endpoint);

        if (!class_exists($Endpoint))
            throw new InvalidEndpointException("Endpoint not found [$endpoint].");

        return new $Endpoint(new GuzzleHttpClient, $this->config);
    }
}