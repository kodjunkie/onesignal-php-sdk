<?php

namespace Endpoints;

use Kodjunkie\OnesignalPhpSdk\Endpoints\App;
use Kodjunkie\OnesignalPhpSdk\Http\ClientInterface;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    /**
     * @var App
     */
    public $app;
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
        $this->app = new App($this->client, $this->config);
    }

    public function test_it_can_get_all_apps()
    {
        $this->client->expects()->setAuthKey($this->config['auth_key'])->once()->andReturn($this->client);
        $this->client->expects()->get('apps')->once()->andReturn(true);

        $success = (bool)$this->app->getAll();
        $this->assertTrue($success);
    }

    public function test_it_can_get_an_app()
    {
        $this->client->expects()->setAuthKey($this->config['auth_key'])->twice()->andReturn($this->client);

        // Called with the default config "app id"
        $this->client->expects()->get('apps/' . $this->config['app_id'])->once()->andReturn(true);
        $success = (bool)$this->app->get();
        $this->assertTrue($success);

        // Called with a custom "app id"
        $appId = 'app-id';
        $this->client->expects()->get('apps/' . $appId)->once()->andReturn(true);
        $this->assertTrue((bool)$this->app->get($appId));
    }

    public function test_it_can_create_an_app()
    {
        $payload = ['name' => 'Demo App'];
        $this->client->expects()->setAuthKey($this->config['auth_key'])->once()->andReturn($this->client);
        $this->client->expects()->post('apps', $payload)->once()->andReturn(true);

        $success = (bool)$this->app->create($payload);
        $this->assertTrue($success);
    }

    public function test_it_can_update_an_app()
    {
        $payload = ['name' => 'Updated App'];
        $this->client->expects()->setAuthKey($this->config['auth_key'])->once()->andReturn($this->client);
        $this->client->expects()->put('apps/' . $this->config['app_id'], $payload)->once()->andReturn(true);

        $success = (bool)$this->app->update($payload);
        $this->assertTrue($success);
    }

    public function test_it_can_view_outcomes()
    {
        $payload = ['outcome_names' => ['os__session_duration.count', 'os__click.count']];
        $this->client->expects()->setAuthKey($this->config['api_key'])->once()->andReturn($this->client);
        $this->client->expects()->get('apps/' . $this->config['app_id'] . '/outcomes', $payload)->once()->andReturn(true);

        $success = (bool)$this->app->outcomes(null, $payload);
        $this->assertTrue($success);
    }

    public function test_it_can_update_tags()
    {
        $externalUserId = 'external-user-id';
        $payload = ['country_code' => "NG", 'state' => "F.C.T"];
        $this->client->expects()->setAuthKey($this->config['auth_key'])->once()->andReturn($this->client);
        $this->client->expects()->put('apps/' . $this->config['app_id'] . '/users/' . $externalUserId, ['tags' => $payload])->once()->andReturn(true);

        $success = (bool)$this->app->updateTags($payload, $externalUserId);
        $this->assertTrue($success);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        \Mockery::close();
        $this->app = null;
    }
}
