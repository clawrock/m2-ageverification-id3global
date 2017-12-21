<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values;

use ClawRock\ID3Global\Model\Values\Profile;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\Profile
 */
class ProfileTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\Profile::toStdClass
     */
    public function testValue()
    {
        $profile = new Profile('profile_id', 2);

        $expected = (object) [
            'ID'      => 'profile_id',
            'Version' => 2
        ];
        $this->assertEquals($expected, $profile->toStdClass());
    }
}
