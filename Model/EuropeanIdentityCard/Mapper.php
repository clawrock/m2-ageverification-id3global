<?php

namespace ClawRock\ID3Global\Model\EuropeanIdentityCard;

use ClawRock\ID3Global\Model\InputDataMapperInterface;
use ClawRock\ID3Global\Model\Transformers\Addresses;
use ClawRock\ID3Global\Model\Transformers\EuropeanIdentityCard;
use ClawRock\ID3Global\Model\Transformers\Personal;
use ClawRock\ID3Global\Model\Values\IdentityDocuments;
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

    /**
     * @var EuropeanIdentityCard
     */
    private $document;

    public function __construct(Personal $personal, Addresses $addresses, EuropeanIdentityCard $document)
    {
        $this->personal = $personal;
        $this->addresses = $addresses;
        $this->document = $document;
    }

    public function mapRequest(DataObject $request): InputData
    {
        return new InputData(
            $this->personal->transform($request),
            $this->addresses->transform($request),
            new IdentityDocuments([
                $this->document->transform($request)
            ])
        );
    }
}
