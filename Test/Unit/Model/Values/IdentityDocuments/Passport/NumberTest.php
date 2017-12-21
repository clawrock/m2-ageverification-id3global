<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments\Passport;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number
 */
class NumberTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number::getValue
     */
    public function testValue()
    {
        $number = new Number('123-456');

        $this->assertEquals('123-456', $number->getValue());
    }
}
