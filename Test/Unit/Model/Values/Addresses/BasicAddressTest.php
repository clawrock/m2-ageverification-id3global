<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\Addresses;

use ClawRock\ID3Global\Model\Values\Addresses\BasicAddress;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\Addresses\BasicAddress
 */
class BasicAddressTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\Addresses\BasicAddress::toStdClass
     */
    public function testValue()
    {
        $address = new BasicAddress('street', 'city', 'region', 'postcode', 'country');

        $expected = (object) [
            'Street' => 'street',
            'SubStreet' => '',
            'Region' => 'region',
            'City' => 'city',
            'ZipPostcode' => 'postcode',
            'Country' => 'country'
        ];

        $this->assertEquals($expected, $address->toStdClass());
    }
}
