<?php

namespace Kodjunkie\OnesignalPhpSdk\Endpoints;

use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;

abstract class Base
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client
     * @param array $config
     */
    public function __construct(ClientInterface $client, array $config = [])
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @return ClientInterface
     */
    protected function client(): ClientInterface
    {
        return $this->client->setAuthKey($this->config['api_key']);
    }
}
