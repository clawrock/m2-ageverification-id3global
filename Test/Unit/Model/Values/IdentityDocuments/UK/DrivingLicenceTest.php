<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments\UK;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence\Number;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence
 */
class DrivingLicenceTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence::toStdClass
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence::getAggregateName
     */
    public function testValue()
    {
        $drivingLicence = new DrivingLicence(new Number('123-456'));

        $this->assertEquals(DrivingLicence::NAME, $drivingLicence->getAggregateName());

        $expected = (object) [
            'Number' => '123-456'
        ];
        $this->assertEquals($expected, $drivingLicence->toStdClass());
    }
}
