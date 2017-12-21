<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers\Personal;

use ClawRock\ID3Global\Model\Transformers\Personal\Gender;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\Personal\Gender
 */
class GenderTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\Personal\Gender::transform
     */
    public function testTransform()
    {
        $transformer = new Gender();

        $gender = $transformer->transform(new DataObject([
            Gender::GENDER_FIELD => Gender::MALE
        ]));

        $this->assertEquals('Male', $gender->getValue());
    }
}
