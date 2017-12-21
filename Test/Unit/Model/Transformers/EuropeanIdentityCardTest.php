<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers;

use ClawRock\ID3Global\Model\Transformers\EuropeanIdentityCard;
use ClawRock\MagentoTesting\TestCase;
use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Directory\Api\Data\CountryInformationInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Stdlib\DateTime\Filter\Date;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\EuropeanIdentityCard
 */
class EuropeanIdentityCardTest extends TestCase
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
     * @var Date|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $dateFilterMock;

    /**
     * @var EuropeanIdentityCard
     */
    protected $model;

    protected function setUp()
    {
        $this->countryInformationAcquirerMock = $this->getMockBuilder(CountryInformationAcquirerInterface::class)
            ->getMockForAbstractClass();

        $this->countryInformationMock = $this->getMockBuilder(CountryInformationInterface::class)
            ->getMockForAbstractClass();

        $this->dateFilterMock = $this->getMockBuilder(Date::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = $this->createObject(EuropeanIdentityCard::class, [
            'countryInformation' => $this->countryInformationAcquirerMock,
            'dateFilter' => $this->dateFilterMock,
        ]);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\EuropeanIdentityCard::transform
     */
    public function testTransform()
    {
        $this->countryInformationAcquirerMock->expects($this->exactly(2))
            ->method('getCountryInfo')
            ->willReturn($this->countryInformationMock);

        $this->countryInformationMock->expects($this->exactly(2))
            ->method('getFullNameEnglish')
            ->willReturn('country');

        $this->dateFilterMock->expects($this->once())
            ->method('filter')
            ->willReturn('2020-01-01');

        $euId = $this->model->transform(new DataObject([
            EuropeanIdentityCard::LINES_FIELD => ['line1', 'line2', 'line3'],
        ]));

        $expected = $expected = (object) [
            'Line1' => 'line1',
            'Line2' => 'line2',
            'Line3' => 'line3',
            'ExpiryDay' => 1,
            'ExpiryMonth' => 1,
            'ExpiryYear' => 2020,
            'CountryOfNationality' => 'country',
            'CountryOfIssue' => 'country',
        ];

        $this->assertEquals($expected, $euId->toStdClass());
    }
}
