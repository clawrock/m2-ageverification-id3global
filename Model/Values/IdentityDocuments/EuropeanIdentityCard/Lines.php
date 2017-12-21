<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard;

class Lines
{
    /**
     * @var array
     */
    private $lines;

    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public function getLine1()
    {
        return $this->lines[0] ?? null;
    }

    public function getLine2()
    {
        return $this->lines[1] ?? null;
    }

    public function getLine3()
    {
        return $this->lines[2] ?? null;
    }
}
