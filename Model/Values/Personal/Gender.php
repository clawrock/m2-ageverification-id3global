<?php

namespace ClawRock\ID3Global\Model\Values\Personal;

class Gender
{
    const MALE        = 'Male';
    const FEMALE      = 'Female';
    const UNKNOWN     = 'Unknown';
    const UNSPECIFIED = 'Unspecified';

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var array
     */
    private $types = [self::MALE, self::FEMALE, self::UNKNOWN, self::UNSPECIFIED];

    public function __construct(string $gender)
    {
        if (!in_array($gender, $this->types)) {
            throw new \RangeException('Wrong gender type.');
        }

        $this->gender = $gender;
    }

    public function getValue(): string
    {
        return $this->gender;
    }
}
