<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments\UK;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\DocumentAggregateInterface;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence\Number;

class DrivingLicence implements DocumentAggregateInterface
{
    const NAME = 'DrivingLicence';

    /**
     * @var Number
     */
    private $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    public function getAggregateName(): string
    {
        return self::NAME;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'Number' => $this->number->getValue(),
        ];
    }
}
