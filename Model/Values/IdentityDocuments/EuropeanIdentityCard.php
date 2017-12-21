<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines;

class EuropeanIdentityCard implements DocumentAggregateInterface
{
    const NAME = 'EuropeanIdentityCard';

    /**
     * @var Lines
     */
    private $lines;

    /**
     * @var Date
     */
    private $expiry;

    /**
     * @var Countries
     */
    private $countries;

    public function __construct(Lines $lines, Date $expiry, Countries $countries)
    {
        $this->lines     = $lines;
        $this->expiry    = $expiry;
        $this->countries = $countries;
    }

    public function getAggregateName(): string
    {
        return self::NAME;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'Line1'                => $this->lines->getLine1(),
            'Line2'                => $this->lines->getLine2(),
            'Line3'                => $this->lines->getLine3(),

            'ExpiryDay'            => $this->expiry->getDay(),
            'ExpiryMonth'          => $this->expiry->getMonth(),
            'ExpiryYear'           => $this->expiry->getYear(),

            'CountryOfNationality' => $this->countries->getCountryOfNationality(),
            'CountryOfIssue'       => $this->countries->getCountryOfIssue(),
        ];
    }
}
