<?php

namespace Endpoints;

use Kodjunkie\OnesignalPhpSdk\Endpoints\Notification;
use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    /**
     * @var Notification
     */
    public $notification;
    /**
     * @var ClientInterface
     */
    public $client;
    /**
     * @var array
     */
    public $config = [
        'api_key' => "test-api-key",
        'auth_key' => "test-auth-key",
        "app_id" => "test-app-id"
    ];

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        $this->client = \Mockery::mock(ClientInterface::class);
        $this->notification = new Notification($this->client, $this->config);

        $this->client->expects()->setAuthKey($this->config['api_key'])->once()->andReturn($this->client);
    }

    public function test_it_can_get_all_notifications()
    {
        $this->client->expects()->get('notifications', [
            'app_id' => $this->config['app_id'],
            'limit' => 100,
            'offset' => 0
        ])->once()->andReturn(true);

        $success = (bool)$this->notification->getAll();
        $this->assertTrue($success);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        \Mockery::close();
        $this->notification = null;
    }
}
