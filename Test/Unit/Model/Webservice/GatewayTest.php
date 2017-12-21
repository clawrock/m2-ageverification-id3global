<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Webservice;

use ClawRock\AgeVerification\Exception\CustomerAuthenticationException;
use ClawRock\ID3Global\Helper\Config;
use ClawRock\ID3Global\Model\Request;
use ClawRock\ID3Global\Model\Result;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Webservice\Gateway
 */
class GatewayTest extends TestCase
{
    /**
     * @var Config|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $configMock;

    /**
     * @var \SoapClient|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $soapClientMock;

    /**
     * @var Request|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $requestMock;

    /**
     * @var \stdClass
     */
    protected $successResponseMock;

    /**
     * @var \stdClass
     */
    protected $failureResponseMock;

    /**
     * @var GatewayMock
     */
    protected $model;

    protected function setUp()
    {
        $this->configMock = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->soapClientMock = $this->getMockBuilder(\SoapClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['__setSoapHeaders', 'AuthenticateSP'])
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->successResponseMock = (object) [
            'AuthenticateSPResult' => (object) [
                'BandText' => Result::BAND_TEXT_PASS,
                'AuthenticationID' => '00000000-0000-0000-0000-000000000000',
            ],
        ];

        $this->failureResponseMock = (object) [
            'AuthenticateSPResult' => (object) [
                'BandText' => 'Fail',
            ],
        ];

        $this->model = $this->createObject(GatewayMock::class, [
            'config' => $this->configMock
        ]);

        $this->model->setClient($this->soapClientMock);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Webservice\Gateway::authenticate
     */
    public function testAuthenticate()
    {
        $this->requestMock->expects($this->once())->method('toStdClass')->willReturn(new \stdClass());
        $this->soapClientMock->expects($this->once())->method('AuthenticateSP')->willReturn($this->successResponseMock);

        $result = $this->model->authenticate($this->requestMock);
        $this->assertTrue($result->isAuthorized());
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Webservice\Gateway::authenticate
     */
    public function testAuthenticateFailure()
    {
        $this->expectException(CustomerAuthenticationException::class);
        $this->requestMock->expects($this->once())->method('toStdClass')->willReturn(new \stdClass());
        $this->soapClientMock->expects($this->once())->method('AuthenticateSP')->willReturn($this->failureResponseMock);

        $this->model->authenticate($this->requestMock);
    }
}
