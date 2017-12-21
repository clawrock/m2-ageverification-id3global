<?php

namespace ClawRock\ID3Global\Model\Transformers\Addresses;

use ClawRock\ID3Global\Model\Values\Addresses\CurrentAddress as CurrentAddressValue;
use Magento\Framework\DataObject;

class CurrentAddress
{
    const STREET_FIELD   = 'street';
    const CITY_FIELD     = 'city';
    const REGION_FIELD   = 'region_id';
    const POSTCODE_FIELD = 'postcode';
    const COUNTRY_FIELD  = 'country_id';

    /**
     * @var \Magento\Directory\Api\CountryInformationAcquirerInterface
     */
    protected $countryInformation;

    public function __construct(
        \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformation
    ) {
        $this->countryInformation = $countryInformation;
    }

    public function transform(DataObject $request): CurrentAddressValue
    {
        $countryInfo = $this->countryInformation->getCountryInfo($request->getData(self::COUNTRY_FIELD));

        $country = $countryInfo->getFullNameEnglish();
        $regions = $countryInfo->getAvailableRegions();

        $region = $request->getData(self::REGION_FIELD);

        foreach ($regions as $regionInfo) {
            /** @var \Magento\Directory\Api\Data\RegionInformationInterface $regionInfo */
            if ($regionInfo->getId() == $region) {
                $region = $regionInfo->getName();
                break;
            }
        }

        return new CurrentAddressValue(
            $request->getData(self::STREET_FIELD),
            $request->getData(self::CITY_FIELD),
            $region,
            $request->getData(self::POSTCODE_FIELD),
            $country
        );
    }
}
