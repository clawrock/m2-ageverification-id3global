<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers\Addresses;

use ClawRock\ID3Global\Model\Transformers\Addresses\CurrentAddress;
use ClawRock\MagentoTesting\TestCase;
use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Directory\Api\Data\CountryInformationInterface;
use Magento\Directory\Api\Data\RegionInformationInterface;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\Addresses\CurrentAddress
 */
class CurrentAddressTest extends TestCase
{
    /**
     * @var CountryInformationAcquirerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $countryInformationAcquirerMock;

    /**
     * @var CountryInformationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $countryInformationMock;

    /**
     * @var RegionInformationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $regionInformationMock;

    /**
     * @var CurrentAddress
     */
    protected $model;

    protected function setUp()
    {
        $this->countryInformationAcquirerMock = $this->getMockBuilder(CountryInformationAcquirerInterface::class)
            ->getMockForAbstractClass();

        $this->countryInformationMock = $this->getMockBuilder(CountryInformationInterface::class)
            ->getMockForAbstractClass();

        $this->regionInformationMock = $this->getMockBuilder(RegionInformationInterface::class)
            ->getMockForAbstractClass();

        $this->model = $this->createObject(CurrentAddress::class, [
            'countryInformation' => $this->countryInformationAcquirerMock,
        ]);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\Addresses\CurrentAddress::transform
     */
    public function testTransform()
    {
        $this->countryInformationAcquirerMock->expects($this->once())
            ->method('getCountryInfo')
            ->willReturn($this->countryInformationMock);

        $this->countryInformationMock->expects($this->once())
            ->method('getAvailableRegions')
            ->willReturn([$this->regionInformationMock]);

        $this->countryInformationMock->expects($this->once())
            ->method('getFullNameEnglish')
            ->willReturn('country');

        $this->regionInformationMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $this->regionInformationMock->expects($this->once())
            ->method('getName')
            ->willReturn('region');

        $currentAddress = $this->model->transform(new DataObject([
            CurrentAddress::STREET_FIELD => 'street',
            CurrentAddress::CITY_FIELD => 'city',
            CurrentAddress::REGION_FIELD => '1',
            CurrentAddress::POSTCODE_FIELD => 'postcode',
            CurrentAddress::COUNTRY_FIELD => '1',
        ]));

        $expected = (object) [
            'Street'      => 'street',
            'SubStreet'   => '',
            'Region'      => 'region',
            'City'        => 'city',
            'ZipPostcode' => 'postcode',
            'Country'     => 'country',
        ];

        $this->assertEquals($expected, $currentAddress->toStdClass());
    }
}
