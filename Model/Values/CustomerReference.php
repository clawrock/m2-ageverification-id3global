<?php

namespace ClawRock\ID3Global\Model\Values;

class CustomerReference
{
    /**
     * @var string
     */
    private $reference;

    public function __construct(string $reference = null)
    {
        $this->reference = $reference;
    }

    public function __toString()
    {
        return (string) $this->reference;
    }
}
