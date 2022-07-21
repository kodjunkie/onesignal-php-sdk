<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Illuminate\Support\Arr;
use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidConfigurationException;
use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidEndpointException;
use Kodjunkie\OnesignalPhpSdk\Http\GuzzleHttpClient;

abstract class Service
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     * @throws InvalidConfigurationException
     */
    final public function __construct(array $config = [])
    {
        if (!Arr::has($config, ['api_key', 'auth_key']))
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
        if (!class_exists($endpoint))
            throw new InvalidEndpointException("Endpoint not found [$endpoint].");

        return new $endpoint(new GuzzleHttpClient, $this->config);
    }
}