<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\Personal;

use ClawRock\ID3Global\Model\Values\Personal\Name;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\Personal\Name
 */
class NameTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\Personal\Name::getFirstname
     * @covers \ClawRock\ID3Global\Model\Values\Personal\Name::getLastname
     * @covers \ClawRock\ID3Global\Model\Values\Personal\Name::getTitle
     */
    public function testValue()
    {
        $name = new Name('firstname', 'lastname', 'title');

        $this->assertEquals('firstname', $name->getFirstname());
        $this->assertEquals('lastname', $name->getLastname());
        $this->assertEquals('title', $name->getTitle());
    }
}
