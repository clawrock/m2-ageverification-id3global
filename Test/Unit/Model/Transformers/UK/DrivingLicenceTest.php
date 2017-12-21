<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers\UK;

use ClawRock\ID3Global\Model\Transformers\UK\DrivingLicence;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\UK\DrivingLicence
 */
class DrivingLicenceTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\UK\DrivingLicence::transform
     */
    public function testTransform()
    {
        $transformer = new DrivingLicence();

        $drivingLicence = $transformer->transform(new DataObject([
            DrivingLicence::NUMBER_FIELD => '123-456'
        ]));

        $expected = (object) [
            'Number' => '123-456'
        ];

        $this->assertEquals($expected, $drivingLicence->toStdClass());
    }
}
