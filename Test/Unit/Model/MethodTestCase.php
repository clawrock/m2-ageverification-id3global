<?php

namespace ClawRock\ID3Global\Test\Unit\Model;

use ClawRock\AgeVerification\Api\Data\ResultInterface;
use ClawRock\ID3Global\Helper\Config;
use ClawRock\ID3Global\Model\InputDataMapperInterface;
use ClawRock\ID3Global\Model\Webservice\GatewayInterface;
use ClawRock\MagentoTesting\TestCase;
use Magento\Customer\Model\Customer;
use Magento\Framework\ObjectManagerInterface;

class MethodTestCase extends TestCase
{
    /**
     * @var Config|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $configMock;

    /**
     * @var GatewayInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $gatewayMock;

    /**
     * @var ObjectManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectManagerMock;

    /**
     * @var InputDataMapperInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $inputDataMapperMock;

    /**
     * @var Customer|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $customerMock;

    /**
     * @var ResultInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $resultMock;

    protected function setUp()
    {
        $this->configMock = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayMock = $this->getMockBuilder(GatewayInterface::class)
            ->getMockForAbstractClass();

        $this->objectManagerMock = $this->getMockBuilder(ObjectManagerInterface::class)
            ->getMockForAbstractClass();

        $this->inputDataMapperMock = $this->getMockBuilder(InputDataMapperInterface::class)
            ->getMockForAbstractClass();

        $this->customerMock = $this->getMockBuilder(Customer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resultMock = $this->getMockBuilder(ResultInterface::class)
            ->getMockForAbstractClass();
    }
}
