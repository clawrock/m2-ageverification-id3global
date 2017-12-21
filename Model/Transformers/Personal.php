<?php

namespace ClawRock\ID3Global\Model\Transformers;

use ClawRock\AgeVerification\Model\Transformers\Dob;
use ClawRock\ID3Global\Model\Values\Personal as PersonalValue;
use ClawRock\ID3Global\Model\Transformers\Personal\Gender;
use ClawRock\ID3Global\Model\Transformers\Personal\Name;
use Magento\Framework\DataObject;

class Personal
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

    public function transform(DataObject $request): PersonalValue
    {
        return new PersonalValue(
            $this->dob->transform($request),
            $this->name->transform($request),
            $this->gender->transform($request)
        );
    }
}
