<?php

namespace Endpoints;

use Kodjunkie\OnesignalPhpSdk\Endpoints\Segment;
use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;
use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase
{
    /**
     * @var Segment
     */
    public $segment;
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
        $this->segment = new Segment($this->client, $this->config);

        $this->client->expects()->setAuthKey($this->config['api_key'])->once()->andReturn($this->client);
    }

    public function test_it_can_create_a_segment()
    {
        $payload = [
            "name" => "Demo Segment",
            "filters" => [
                ["field" => "session_count", "relation" => ">", "value" => "1"],
                ["operator" => "AND"],
                ["field" => "tag", "relation" => "!=", "key" => "tag_key", "value" => "1"],
                ["operator" => "OR"],
                ["field" => "last_session", "relation" => "<", "hours_ago" => "30"]
            ]
        ];

        $this->client->expects()->post('apps/' . $this->config['app_id'] . '/segments', $payload)->once()->andReturn(true);

        $success = (bool)$this->segment->create($payload);
        $this->assertTrue($success);
    }

    public function test_it_can_delete_a_segment()
    {
        $segmentId = 'demo-segment-id';
        $this->client->expects()->delete('apps/' . $this->config['app_id'] . '/segments/' . $segmentId)->once()->andReturn(true);

        $success = (bool)$this->segment->delete($segmentId);
        $this->assertTrue($success);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        \Mockery::close();
        $this->segment = null;
    }
}
