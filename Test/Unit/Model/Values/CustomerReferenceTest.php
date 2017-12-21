<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values;

use ClawRock\ID3Global\Model\Values\CustomerReference;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\CustomerReference
 */
class CustomerReferenceTest extends TestCase
{
    public function testValue()
    {
        $this->assertEquals('ref', (string) new CustomerReference('ref'));
        $this->assertEquals('', (string) new CustomerReference());
    }
}
