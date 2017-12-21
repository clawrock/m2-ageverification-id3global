<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\InternationalPassport;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\InternationalPassport
 */
class InternationalPassportTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\InternationalPassport::toStdClass
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\InternationalPassport::getAggregateName
     */
    public function testValue()
    {
        $dt = new \DateTime();
        $passport = new InternationalPassport(new Number('123-456'), new Date($dt));

        $this->assertEquals(InternationalPassport::NAME, $passport->getAggregateName());
        $expected = (object) [
            'Number' => '123-456',
            'ExpiryDay' => $dt->format('d'),
            'ExpiryMonth' => $dt->format('m'),
            'ExpiryYear' => $dt->format('Y'),
        ];
        $this->assertEquals($expected, $passport->toStdClass());
    }
}
