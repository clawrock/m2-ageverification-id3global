<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments\EuropeanIdentityCard;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines
 */
class LinesTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines::getLine1
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines::getLine2
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\EuropeanIdentityCard\Lines::getLine3
     */
    public function testValue()
    {
        $lines = new Lines(['line1', 'line2', 'line3']);

        $this->assertEquals('line1', $lines->getLine1());
        $this->assertEquals('line2', $lines->getLine2());
        $this->assertEquals('line3', $lines->getLine3());
    }
}
