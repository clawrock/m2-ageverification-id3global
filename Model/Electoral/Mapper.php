<?php

namespace ClawRock\ID3Global\Model\Electoral;

use ClawRock\ID3Global\Model\InputDataMapperInterface;
use ClawRock\ID3Global\Model\Transformers\Addresses;
use ClawRock\ID3Global\Model\Transformers\Personal;
use ClawRock\ID3Global\Model\Values\InputData;
use Magento\Framework\DataObject;

class Mapper implements InputDataMapperInterface
{
    /**
     * @var Personal
     */
    private $personal;

    /**
     * @var Addresses
     */
    private $addresses;

    public function __construct(Personal $personal, Addresses $addresses)
    {
        $this->personal  = $personal;
        $this->addresses = $addresses;
    }

    public function mapRequest(DataObject $request): InputData
    {
        return new InputData(
            $this->personal->transform($request),
            $this->addresses->transform($request)
        );
    }
}
