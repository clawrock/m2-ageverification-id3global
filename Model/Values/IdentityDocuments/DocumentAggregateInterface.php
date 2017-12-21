<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments;

use ClawRock\ID3Global\Model\StdClassSerializableInterface;

interface DocumentAggregateInterface extends StdClassSerializableInterface
{
    public function getAggregateName(): string;
}
