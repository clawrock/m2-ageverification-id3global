<?php

namespace ClawRock\ID3Global\Model;

use ClawRock\ID3Global\Model\Values\CustomerReference;
use ClawRock\ID3Global\Model\Values\InputData;
use ClawRock\ID3Global\Model\Values\Profile;

class Request implements StdClassSerializableInterface
{
    /**
     * @var Profile
     */
    private $profile;

    /**
     * @var CustomerReference
     */
    private $reference;

    /**
     * @var InputData
     */
    private $inputData;

    public function __construct(Profile $profile, InputData $inputData, CustomerReference $reference = null)
    {
        $this->profile   = $profile;
        $this->inputData = $inputData;
        $this->reference = $reference ?: new CustomerReference();
    }

    public function setCustomerReference(CustomerReference $reference)
    {
        $this->reference = $reference;

        return $this;
    }

    public function toStdClass(): \stdClass
    {
        $object = new \stdClass;

        $object->ProfileIDVersion  = $this->profile->toStdClass();
        $object->CustomerReference = (string) $this->reference;
        $object->InputData         = $this->inputData->toStdClass();

        return $object;
    }
}
