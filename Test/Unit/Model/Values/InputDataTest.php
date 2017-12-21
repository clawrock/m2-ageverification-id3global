<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values;

use ClawRock\AgeVerification\Model\Values\Dob;
use ClawRock\ID3Global\Model\Values\InputData;
use ClawRock\ID3Global\Model\Values\Personal;
use ClawRock\ID3Global\Model\Values\Personal\Gender;
use ClawRock\ID3Global\Model\Values\Personal\Name;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\InputData
 */
class InputDataTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\InputData::toStdClass
     */
    public function testValue()
    {
        $dt = new \DateTime();
        $dob = new Dob($dt);
        $name = new Name('firstname', 'lastname');
        $gender = new Gender('Male');
        $inputData = new InputData(new Personal($dob, $name, $gender));

        $expected = (object) [
            'Personal' => (object) [
                'PersonalDetails' => (object) [
                    'Gender'   => 'Male',
                    'Title'    => null,
                    'Forename' => 'firstname',
                    'Surname'  => 'lastname',
                    'DOBDay'   => (int) $dt->format('d'),
                    'DOBMonth' => (int) $dt->format('m'),
                    'DOBYear'  => (int) $dt->format('Y'),
                ],
            ],
            'Addresses' => null,
            'IdentityDocuments' => (object) [],
        ];
        $this->assertEquals($expected, $inputData->toStdClass());
    }
}
