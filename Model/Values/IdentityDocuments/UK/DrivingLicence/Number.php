<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence;

class Number
{
    /**
     * @var string
     */
    private $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getValue(): string
    {
        return $this->number;
    }
}
