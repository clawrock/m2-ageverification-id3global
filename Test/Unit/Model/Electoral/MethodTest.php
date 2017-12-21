<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Electoral;

use ClawRock\AgeVerification\Api\Data\PersistableResultInterface;
use ClawRock\AgeVerification\Api\Data\ResultInterface;
use ClawRock\ID3Global\Model\Electoral\Mapper;
use ClawRock\ID3Global\Model\Electoral\Method;
use ClawRock\ID3Global\Test\Unit\Model\MethodTestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Electoral\Method
 */
class MethodTest extends MethodTestCase
{
    /**
     * @var Method
     */
    protected $model;

    protected function setUp()
    {
        parent::setUp();

        $this->model = $this->createObject(Method::class, [
            'config' => $this->configMock,
            'gateway' => $this->gatewayMock,
            'objectManager' => $this->objectManagerMock,
        ]);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Electoral\Method::isCustomerAuthenticated
     */
    public function testIsCustomerAuthenticated()
    {
        $this->customerMock->expects($this->exactly(3))
            ->method('getData')
            ->withConsecutive(
                [PersistableResultInterface::IS_VERIFIED_FIELD],
                [PersistableResultInterface::TOKEN_FIELD],
                [PersistableResultInterface::METHOD_FIELD]
            )
            ->willReturnOnConsecutiveCalls('1', 'token', 'method');

        $this->assertTrue($this->model->isCustomerAuthenticated($this->customerMock));
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Electoral\Method::isCustomerAuthenticated
     */
    public function testIsCustomerNotAuthenticated()
    {
        $this->customerMock->expects($this->atLeastOnce())
            ->method('getData')
            ->withConsecutive(
                [PersistableResultInterface::IS_VERIFIED_FIELD],
                [PersistableResultInterface::TOKEN_FIELD],
                [PersistableResultInterface::METHOD_FIELD]
            )
            ->willReturnOnConsecutiveCalls('0', '', '');

        $this->assertFalse($this->model->isCustomerAuthenticated($this->customerMock));
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Electoral\Method::getTitle
     */
    public function testGetTitle()
    {
        $this->assertEquals(Method::METHOD_TITLE, $this->model->getTitle());
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Electoral\Method::authenticate
     */
    public function testAuthenticate()
    {
        $this->objectManagerMock->expects($this->once())
            ->method('get')
            ->with(Mapper::class)
            ->willReturn($this->inputDataMapperMock);

        $this->gatewayMock->expects($this->once())
            ->method('authenticate')
            ->willReturn($this->resultMock);

        $this->assertInstanceOf(ResultInterface::class, $this->model->authenticate(new DataObject()));
    }
}
