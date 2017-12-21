<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers\Personal;

use ClawRock\ID3Global\Model\Transformers\Personal\Name;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\Personal\Name
 */
class NameTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\Personal\Name::transform
     */
    public function testTransform()
    {
        $transformer = new Name();

        $name = $transformer->transform(new \Magento\Framework\DataObject([
            Name::FIRSTNAME_FIELD => 'firstname',
            Name::LASTNAME_FIELD => 'lastname',
            Name::TITLE_FIELD => 'title',
        ]));

        $this->assertEquals('firstname', $name->getFirstname());
        $this->assertEquals('lastname', $name->getLastname());
        $this->assertEquals('title', $name->getTitle());
    }
}
