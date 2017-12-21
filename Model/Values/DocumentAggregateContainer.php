<?php

namespace ClawRock\ID3Global\Model\Values;

use ClawRock\ID3Global\Model\StdClassSerializableInterface;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\DocumentAggregateInterface;

class DocumentAggregateContainer implements StdClassSerializableInterface
{
    /**
     * @var DocumentAggregateInterface[]
     */
    private $aggregates = [];

    public function __construct(array $aggregates = [])
    {
        foreach ($aggregates as $aggregate) {
            $this->addDocumentAggregate($aggregate);
        }
    }

    private function addDocumentAggregate(DocumentAggregateInterface $aggregate)
    {
        $this->aggregates[$aggregate->getAggregateName()] = $aggregate;
    }

    public function getAggregates(): array
    {
        return $this->aggregates;
    }

    public function toStdClass(): \stdClass
    {
        return (object) array_map(function ($aggregate) {
            return $aggregate->toStdClass();
        }, $this->getAggregates());
    }
}
