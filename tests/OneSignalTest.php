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
    public function testBuildsAppEndpoint()
    {
        $expected = $this->oneSignal->app();
        $this->assertInstanceOf(App::class, $expected);
    }

    /**
     * @throws OneSignalException
     */
    public function testBuildsDeviceEndpoint()
    {
        $expected = $this->oneSignal->device();
        $this->assertInstanceOf(Device::class, $expected);
    }

    /**
     * @throws OneSignalException
     */
    public function testBuildsNotificationEndpoint()
    {
        $expected = $this->oneSignal->notification();
        $this->assertInstanceOf(Notification::class, $expected);
    }

    /**
     * @throws OneSignalException
     */
    public function testBuildsSegmentEndpoint()
    {
        $expected = $this->oneSignal->segment();
        $this->assertInstanceOf(Segment::class, $expected);
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testThrowsExceptionOnInvalidConfiguration()
    {
        $this->expectException(InvalidConfigurationException::class);
        new OneSignal(['api_key' => '']);
        new OneSignal(['auth_key' => '']);
        new OneSignal(['' => '']);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        $this->oneSignal = null;
    }
}
