<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values\IdentityDocuments;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK
 */
class UKTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\IdentityDocuments\UK::getAggregateName
     */
    public function testValue()
    {
        $uk = new UK();

        $this->assertEquals(UK::NAME, $uk->getAggregateName());
    }
}
