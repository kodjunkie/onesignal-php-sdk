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
    public function __construct(array $config = [])
    {
        if (!isset($config['api_key']) || !isset($config['auth_key']))
            throw new InvalidConfigurationException('Missing required credentials (api_key and/or auth_key).');

        $this->config = $config;
    }

    /**
     * Resolve the endpoint
     * @param $endpoint
     * @return mixed
     * @throws InvalidEndpointException
     */
    protected function build($endpoint)
    {
        $Endpoint = "\\Kodjunkie\\OnesignalPhpSdk\\Endpoints\\" . ucfirst($endpoint);

        if (!class_exists($Endpoint))
            throw new InvalidEndpointException("Endpoint not found: " . $endpoint);

        return new $Endpoint(new GuzzleHttpClient, $this->config);
    }
}