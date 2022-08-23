<?php

namespace Endpoints;

use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;
use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;
use PHPUnit\Framework\TestCase;

class DeviceTest extends TestCase
{
    /**
     * @var Device
     */
    public $device;
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
        $this->device = new Device($this->client, $this->config);

        $this->client->expects()->setAuthKey($this->config['api_key'])->once()->andReturn($this->client);
    }

    public function test_it_can_get_all_devices()
    {
        $this->client->expects()->get('players', [
            'app_id' => $this->config['app_id'],
            'limit' => 300,
            'offset' => 0
        ])->once()->andReturn(true);

        $success = (bool)$this->device->getAll();
        $this->assertTrue($success);
    }

    public function test_it_can_get_a_device()
    {
        $playerId = 'player-id';
        $this->client->expects()->get('players/' . $playerId, [
            'app_id' => $this->config['app_id']
        ])->once()->andReturn(true);

        $success = (bool)$this->device->get($playerId);
        $this->assertTrue($success);
    }

    public function test_it_can_create_a_device()
    {
        $payload = [
            'app_id' => $this->config['app_id'],
            'device_type' => Device::ANDROID,
            'country' => 'US',
            'tags' => [
                'full_name' => 'John Doe'
            ]
        ];
        $this->client->expects()->post('players', $payload)->once()->andReturn(true);

        $success = (bool)$this->device->create($payload);
        $this->assertTrue($success);
    }

    public function test_it_can_update_a_device()
    {
        $playerId = 'player-id';
        $payload = [
            'app_id' => $this->config['app_id'],
            'country' => 'NG',
            'tags' => [
                'full_name' => 'Jane Doe'
            ]
        ];
        $this->client->expects()->put('players/' . $playerId, $payload)->once()->andReturn(true);

        $success = (bool)$this->device->update($playerId, $payload);
        $this->assertTrue($success);
    }

    public function test_it_can_delete_a_device()
    {
        $playerId = 'player-id';
        $this->client->expects()->delete('players/' . $playerId, [
            'app_id' => $this->config['app_id']
        ])->once()->andReturn(true);

        $success = (bool)$this->device->delete($playerId);
        $this->assertTrue($success);
    }

    public function test_it_can_export_device_data_in_csv()
    {
        $payload = [
            'extra_fields' => [
                "country", "notification_types", "external_user_id", "location", "ip", "country"
            ],
            'last_active_since' => '1469392779',
            'segment_name' => 'Subscribed Users'
        ];

        $this->client->expects()->post('players/csv_export', $payload, [
            'app_id' => $this->config['app_id']
        ])->once()->andReturn(true);

        $success = (bool)$this->device->export(null, $payload);
        $this->assertTrue($success);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        \Mockery::close();
        $this->device = null;
    }
}
