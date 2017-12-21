<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers;

use ClawRock\ID3Global\Model\Transformers\InternationalPassport;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\InternationalPassport
 */
class InternationalPassportTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\InternationalPassport::transform
     */
    public function testTransform()
    {
        $transformer = new InternationalPassport();

        $passport = $transformer->transform(new DataObject([
            InternationalPassport::NUMBER_FIELD => '123-456',
            InternationalPassport::EXPIRY_FIELD => '2020-01-01',
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
