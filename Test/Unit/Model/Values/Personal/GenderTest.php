<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\Personal;

use ClawRock\ID3Global\Model\Values\Personal\Gender;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\Personal\Gender
 */
class GenderTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\Personal\Gender::getValue
     */
    public function testValue()
    {
        $gender = new Gender('Male');

        $this->assertEquals('Male', $gender->getValue());
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Values\Personal\Gender::getValue
     */
    public function testRangeException()
    {
        $this->expectException(\RangeException::class);

        new Gender('Wrong gender');
    }
}
