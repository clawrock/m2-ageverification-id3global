<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Countries;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard
 */
class EuropeanIdentityCardTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard::toStdClass
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard::getAggregateName
     */
    public function testValue()
    {
        $lines = new Lines(['line1' , 'line2', 'line3']);
        $dt = new \DateTime();
        $expiry = new Date($dt);
        $countries = new Countries('country1', 'country2');
        $euId = new EuropeanIdentityCard($lines, $expiry, $countries);

        $this->assertEquals(EuropeanIdentityCard::NAME, $euId->getAggregateName());

        $expected = (object) [
            'Line1' => 'line1',
            'Line2' => 'line2',
            'Line3' => 'line3',
            'ExpiryDay' => $dt->format('d'),
            'ExpiryMonth' => $dt->format('m'),
            'ExpiryYear' => $dt->format('Y'),
            'CountryOfNationality' => 'country1',
            'CountryOfIssue' => 'country2',
        ];
        $this->assertEquals($expected, $euId->toStdClass());
    }
}
