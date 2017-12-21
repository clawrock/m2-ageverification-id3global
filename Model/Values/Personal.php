<?php

namespace ClawRock\ID3Global\Model\Values;

use ClawRock\AgeVerification\Model\Values\Dob;
use ClawRock\ID3Global\Model\StdClassSerializableInterface;
use ClawRock\ID3Global\Model\Values\Personal\Gender;
use ClawRock\ID3Global\Model\Values\Personal\Name;

class Personal implements StdClassSerializableInterface
{
    /**
     * @var Dob
     */
    private $dob;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Gender
     */
    private $gender;

    public function __construct(Dob $dob, Name $name, Gender $gender)
    {
        $this->dob    = $dob;
        $this->name   = $name;
        $this->gender = $gender;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'PersonalDetails' => (object) [
                'Gender'   => $this->gender->getValue(),
                'Title'    => $this->name->getTitle(),
                'Forename' => $this->name->getFirstname(),
                'Surname'  => $this->name->getLastname(),
                'DOBDay'   => $this->dob->getDay(),
                'DOBMonth' => $this->dob->getMonth(),
                'DOBYear'  => $this->dob->getYear()
            ]
        ];
    }
}
