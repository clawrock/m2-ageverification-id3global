<?php

namespace ClawRock\ID3Global\Model;

use ClawRock\ID3Global\Model\Values\InputData;
use Magento\Framework\DataObject;

interface InputDataMapperInterface
{
    public function mapRequest(DataObject $request): InputData;
}
