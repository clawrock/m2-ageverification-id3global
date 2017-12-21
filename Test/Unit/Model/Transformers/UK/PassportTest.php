<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers\UK;

use ClawRock\ID3Global\Model\Transformers\UK\Passport;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\UK\Passport
 */
class PassportTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\UK\Passport::transform
     */
    public function testTransform()
    {
        $transformer = new Passport();

        $passport = $transformer->transform(new DataObject([
            Passport::NUMBER_FIELD => '123-456',
            Passport::EXPIRY_FIELD => '2020-01-01',
        ]));

        $expected = (object) [
            'Number'      => '123-456',
            'ExpiryDay'   => 1,
            'ExpiryMonth' => 1,
            'ExpiryYear'  => 2020,
        ];

        $this->assertEquals($expected, $passport->toStdClass());
    }
}
