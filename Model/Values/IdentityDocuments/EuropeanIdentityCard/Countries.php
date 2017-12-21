<?php

namespace ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard;

class Countries
{
    /**
     * @var string
     */
    private $countryOfNationality;

    /**
     * @var string
     */
    private $countryOfIssue;

    public function __construct(string $countryOfNationality = null, string $countryOfIssue = null)
    {
        $this->countryOfNationality = $countryOfNationality;
        $this->countryOfIssue       = $countryOfIssue;
    }

    public function getCountryOfNationality()
    {
        return $this->countryOfNationality;
    }

    public function getCountryOfIssue()
    {
        return $this->countryOfIssue;
    }
}
