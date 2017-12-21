<?php

namespace ClawRock\ID3Global\Test\Unit\Helper;

use ClawRock\ID3Global\Helper\Config;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\App\Helper\Context;

/**
 * @covers \ClawRock\ID3Global\Helper\Config
 */
class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    protected $object;

    protected function setUp()
    {
        $contextMock = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        $contextMock->expects($this->any())
            ->method('getScopeConfig')
            ->willReturn($this->getScopeConfigMock());

        $this->object = $this->createObject(Config::class, [
            'context' => $contextMock
        ]);
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::isEnabled
     */
    public function testIsEnabled()
    {
        $this->mockScopeConfigGetValue(Config::ENABLED, '1');
        $this->assertTrue($this->object->isEnabled());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::getUsername
     */
    public function testGetUsername()
    {
        $this->mockScopeConfigGetValue(Config::USERNAME, 'username');
        $this->assertEquals('username', $this->object->getUsername());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::getPassword
     */
    public function testGetPassword()
    {
        $this->mockScopeConfigGetValue(Config::PASSWORD, 'password');
        $this->assertEquals('password', $this->object->getPassword());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::getProfileId
     */
    public function testGetProfileId()
    {
        $this->mockScopeConfigGetValue(Config::PROFILE_ID, 'profile_id');
        $this->assertEquals('profile_id', $this->object->getProfileId());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::getProfileVersion
     */
    public function testGetProfileVersion()
    {
        $this->mockScopeConfigGetValue(Config::PROFILE_VERSION, '1');
        $this->assertEquals(1, $this->object->getProfileVersion());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::getCustomerReference
     */
    public function testGetCustomerReference()
    {
        $this->mockScopeConfigGetValue(Config::CUSTOMER_REFERENCE, 'customer_reference');
        $this->assertEquals('customer_reference', $this->object->getCustomerReference());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::isDebugEnabled
     */
    public function testIsDebugEnabled()
    {
        $this->mockScopeConfigGetValue(Config::DEBUG_ENABLED, '1');
        $this->assertTrue($this->object->isDebugEnabled());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::getDebugFile
     */
    public function testGetDebugFile()
    {
        $this->mockScopeConfigGetValue(Config::DEBUG_FILE, 'debug.log');
        $this->assertEquals('debug.log', $this->object->getDebugFile());
    }

    /**
     * @covers \ClawRock\ID3Global\Helper\Config::isPilotEnabled
     */
    public function testIsPilotEnabled()
    {
        $this->mockScopeConfigGetValue(Config::PILOT_ENABLED, '1');
        $this->assertTrue($this->object->isPilotEnabled());
    }
}
