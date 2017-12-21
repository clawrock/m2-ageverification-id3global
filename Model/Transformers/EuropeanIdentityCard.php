<?php

namespace ClawRock\ID3Global\Model\Transformers;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard as EuropeanIdentityCardValue;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines;
use Magento\Framework\DataObject;

class EuropeanIdentityCard
{
    const LINES_FIELD               = 'eu_id_lines';
    const EXPIRY_FIELD              = 'expiry_date';
    const NATIONALITY_COUNTRY_FIELD = 'nationality_country_id';
    const ISSUE_COUNTRY_FIELD       = 'issue_country_id';

    /**
     * @var \Magento\Directory\Api\CountryInformationAcquirerInterface
     */
    protected $countryInformation;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;

    public function __construct(
        \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformation,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
    ) {
        $this->countryInformation = $countryInformation;
        $this->dateFilter = $dateFilter;
    }

    public function transform(DataObject $request): EuropeanIdentityCardValue
    {
        $nationalityCountry = $this->countryInformation
            ->getCountryInfo($request->getData(self::NATIONALITY_COUNTRY_FIELD))
            ->getFullNameEnglish();

        $issueCountry = $this->countryInformation
            ->getCountryInfo($request->getData(self::ISSUE_COUNTRY_FIELD))
            ->getFullNameEnglish();

        $date = $this->dateFilter->filter($request->getData(self::EXPIRY_FIELD));

        return new EuropeanIdentityCardValue(
            new Lines($request->getData(self::LINES_FIELD)),
            new Date(new \DateTime($date)),
            new Countries(
                $nationalityCountry,
                $issueCountry
            )
        );
    }
}
