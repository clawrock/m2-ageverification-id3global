<?php

namespace ClawRock\ID3Global\Model\Values;

use ClawRock\ID3Global\Model\StdClassSerializableInterface;

class InputData implements StdClassSerializableInterface
{
    /**
     * @var Personal
     */
    private $personal;

    /**
     * @var Addresses
     */
    private $addresses;

    /**
     * @var IdentityDocuments
     */
    private $documents;

    public function __construct(Personal $personal, Addresses $addresses = null, IdentityDocuments $documents = null)
    {
        $this->personal  = $personal;
        $this->addresses = $addresses;
        $this->documents = $documents ?: new IdentityDocuments();
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'Personal'          => $this->personal->toStdClass(),
            'Addresses'         => $this->addresses ? $this->addresses->toStdClass() : null,
            'IdentityDocuments' => $this->documents->toStdClass()
        ];
    }
}
