<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values;

use ClawRock\ID3Global\Model\Values\Addresses;
use ClawRock\ID3Global\Model\Values\Addresses\CurrentAddress;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\Addresses
 */
class AddressesTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\Addresses::toStdClass
     */
    public function testValue()
    {
        $address = new CurrentAddress('street', 'city', 'region', 'postcode', 'country');
        $addresses = new Addresses($address);

        $expected = (object) [
            'CurrentAddress' => $address->toStdClass(),
        ];
        $this->assertEquals($expected, $addresses->toStdClass());
    }
}
