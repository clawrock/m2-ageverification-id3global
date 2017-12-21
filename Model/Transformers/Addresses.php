<?php

namespace ClawRock\ID3Global\Model\Transformers;

use ClawRock\ID3Global\Model\Values\Addresses as AddressesValue;
use ClawRock\ID3Global\Model\Transformers\Addresses\CurrentAddress;
use Magento\Framework\DataObject;

class Addresses
{
    /**
     * @var CurrentAddress
     */
    protected $currentAddress;

    public function __construct(CurrentAddress $currentAddress)
    {
        $this->currentAddress = $currentAddress;
    }

    public function transform(DataObject $request): AddressesValue
    {
        return new AddressesValue($this->currentAddress->transform($request));
    }
}
