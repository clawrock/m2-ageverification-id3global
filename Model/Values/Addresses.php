<?php

namespace ClawRock\ID3Global\Model\Values;

use ClawRock\ID3Global\Model\StdClassSerializableInterface;
use ClawRock\ID3Global\Model\Values\Addresses\CurrentAddress;

class Addresses implements StdClassSerializableInterface
{
    /**
     * @var CurrentAddress
     */
    private $currentAddress;

    public function __construct(CurrentAddress $address)
    {
        $this->currentAddress = $address;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'CurrentAddress' => $this->currentAddress->toStdClass()
        ];
    }
}
