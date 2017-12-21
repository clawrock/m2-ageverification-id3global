<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers;

use ClawRock\ID3Global\Model\Transformers\Addresses;
use ClawRock\ID3Global\Model\Transformers\Addresses\CurrentAddress;
use ClawRock\ID3Global\Model\Values\Addresses\CurrentAddress as CurrentAddressValue;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\Addresses
 */
class AddressesTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\Addresses::transform
     */
    public function testTransform()
    {
        /** @var CurrentAddress|\PHPUnit_Framework_MockObject_MockObject $currentAddressTransformerMock */
        $currentAddressTransformerMock = $this->getMockBuilder(CurrentAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $currentAddressTransformerMock->expects($this->once())
            ->method('transform')
            ->willReturn(new CurrentAddressValue('street', 'city', 'region', 'postcode', 'country'));

        $transformer = new Addresses($currentAddressTransformerMock);

        $expected = (object) [
            'CurrentAddress' => (object) [
                'Street'      => 'street',
                'SubStreet'   => '',
                'Region'      => 'region',
                'City'        => 'city',
                'ZipPostcode' => 'postcode',
                'Country'     => 'country',
            ]
        ];
        $this->assertEquals($expected, $transformer->transform(new DataObject())->toStdClass());
    }
}
