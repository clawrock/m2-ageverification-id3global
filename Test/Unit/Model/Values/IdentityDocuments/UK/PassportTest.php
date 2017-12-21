<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments\UK;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\Passport;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\Passport
 */
class PassportTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\Passport::toStdClass
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\Passport::getAggregateName
     */
    public function testValue()
    {
        $dt = new \DateTime();
        $passport = new Passport(new Number('123-456'), new Date($dt));

        $this->assertEquals(Passport::NAME, $passport->getAggregateName());

        $expected = (object) [
            'Number' => '123-456',
            'ExpiryDay' => (int) $dt->format('d'),
            'ExpiryMonth' => (int) $dt->format('m'),
            'ExpiryYear' => (int) $dt->format('Y'),
        ];
        $this->assertEquals($expected, $passport->toStdClass());
    }
}
