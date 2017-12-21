<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments\UK;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\DocumentAggregateInterface;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number;

class Passport implements DocumentAggregateInterface
{
    const NAME = 'Passport';

    /**
     * @var Number
     */
    private $number;

    /**
     * @var Date
     */
    private $expiry;

    public function __construct(Number $number, Date $expiry)
    {
        $this->number = $number;
        $this->expiry = $expiry;
    }

    public function getAggregateName(): string
    {
        return self::NAME;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'Number'      => $this->number->getValue(),
            'ExpiryDay'   => $this->expiry->getDay(),
            'ExpiryMonth' => $this->expiry->getMonth(),
            'ExpiryYear'  => $this->expiry->getYear(),
        ];
    }
}
