<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments;

use ClawRock\ID3Global\Model\Values\DocumentAggregateContainer;

class UK extends DocumentAggregateContainer implements DocumentAggregateInterface
{
    const NAME = 'UK';

    public function getAggregateName(): string
    {
        return self::NAME;
    }
}
