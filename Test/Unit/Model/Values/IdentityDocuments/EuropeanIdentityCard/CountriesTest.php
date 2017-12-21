<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments\EuropeanIdentityCard;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries
 */
class CountriesTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries::getCountryOfNationality
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries::getCountryOfIssue
     */
    public function testValue()
    {
        $countries = new Countries('country1', 'country2');

        $this->assertEquals('country1', $countries->getCountryOfNationality());
        $this->assertEquals('country2', $countries->getCountryOfIssue());
    }
}
