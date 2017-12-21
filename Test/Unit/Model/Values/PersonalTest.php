<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values;

use ClawRock\AgeVerification\Model\Values\Dob;
use ClawRock\ID3Global\Model\Values\Personal;
use ClawRock\ID3Global\Model\Values\Personal\Gender;
use ClawRock\ID3Global\Model\Values\Personal\Name;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\Personal
 */
class PersonalTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\Personal::toStdClass
     */
    public function testValue()
    {
        $dt = new \DateTime();
        $dob = new Dob($dt);
        $name = new Name('firstname', 'lastname');
        $gender = new Gender('Male');

        $personal = new Personal($dob, $name, $gender);

        $expected = (object) [
            'PersonalDetails' => (object) [
                'Gender'   => 'Male',
                'Title'    => null,
                'Forename' => 'firstname',
                'Surname'  => 'lastname',
                'DOBDay'   => (int) $dt->format('d'),
                'DOBMonth' => (int) $dt->format('m'),
                'DOBYear'  => (int) $dt->format('Y'),
            ],
        ];

        $this->assertEquals($expected, $personal->toStdClass());
    }
}
