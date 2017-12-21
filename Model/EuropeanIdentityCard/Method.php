<?php

namespace ClawRock\ID3Global\Model\EuropeanIdentityCard;

use ClawRock\ID3Global\Model\AbstractMethod;
use ClawRock\ID3Global\Model\InputDataMapperInterface;

class Method extends AbstractMethod
{
    const METHOD_TITLE = 'European Identity Card';

    protected function getInputDataMapper(): InputDataMapperInterface
    {
        return $this->objectManager->get(Mapper::class);
    }
}
