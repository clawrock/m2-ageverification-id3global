<?php

namespace ClawRock\ID3Global\Model\Values\Addresses;

use ClawRock\ID3Global\Model\StdClassSerializableInterface;

class BasicAddress implements StdClassSerializableInterface
{
    /**
     * @var array
     */
    private $streets;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $region;

    public function __construct($streets, string $city, string $region = null, string $postcode = null, string $country)
    {
        $this->streets  = (array) $streets;
        $this->city     = $city;
        $this->region   = (string) $region;
        $this->postcode = (string) $postcode;
        $this->country  = $country;
    }

    public function toStdClass(): \stdClass
    {
        return (object) [
            'Street'      => $this->streets[0] ?? '',
            'SubStreet'   => $this->streets[1] ?? '',
            'Region'      => $this->region,
            'City'        => $this->city,
            'ZipPostcode' => $this->postcode,
            'Country'     => $this->country
        ];
    }
}
