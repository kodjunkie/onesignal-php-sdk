<?php

use Kodjunkie\OnesignalPhpSdk\Endpoints\App;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Device;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Notification;
use Kodjunkie\OnesignalPhpSdk\Endpoints\Segment;
use Kodjunkie\OnesignalPhpSdk\Exceptions\InvalidConfigurationException;
use Kodjunkie\OnesignalPhpSdk\Exceptions\OneSignalException;
use Kodjunkie\OnesignalPhpSdk\OneSignal;
use PHPUnit\Framework\TestCase;

class OneSignalTest extends TestCase
{
    /**
     * @var OneSignal
     */
    public $oneSignal;

    /**
     * This method is called before each test.
     * @throws InvalidConfigurationException
     */
    public function setUp(): void
    {
        $config = ['api_key' => "1234", 'auth_key' => "4321"];
        $this->oneSignal = new OneSignal($config);
    }

    /**
     * @throws OneSignalException
     */
    public function test_has_support_for_apps()
    {
        $expected = $this->oneSignal->app();
        $this->assertInstanceOf(App::class, $expected);
    }

    /**
     * @throws OneSignalException
     */
    public function test_has_support_for_devices()
    {
        $expected = $this->oneSignal->device();
        $this->assertInstanceOf(Device::class, $expected);
    }

    /**
     * @throws OneSignalException
     */
    public function test_has_support_for_notifications()
    {
        $expected = $this->oneSignal->notification();
        $this->assertInstanceOf(Notification::class, $expected);
    }

    /**
     * @throws OneSignalException
     */
    public function test_has_support_for_segments()
    {
        $expected = $this->oneSignal->segment();
        $this->assertInstanceOf(Segment::class, $expected);
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function test_throws_exception_for_invalid_api_key()
    {
        $this->expectException(InvalidConfigurationException::class);
        new OneSignal(['api_key' => '']);
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function test_throws_exception_for_invalid_auth_key()
    {
        $this->expectException(InvalidConfigurationException::class);
        new OneSignal(['auth_key' => '']);
    }

    /**
     */
    public function test_throws_exception_for_invalid_configuration()
    {
        $this->expectException(InvalidConfigurationException::class);
        new OneSignal();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        $this->oneSignal = null;
    }
}
