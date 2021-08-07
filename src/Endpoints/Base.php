<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Clients\HttpClient;

abstract class Base
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @param HttpClient $client
     * @param array $config
     */
    public function __construct(HttpClient $client, array $config = [])
    {
        $this->client = $client;
        $this->config = $config;
    }
}
