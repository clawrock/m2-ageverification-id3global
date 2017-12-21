<?php

namespace ClawRock\ID3Global\Test\Unit\Model\EuropeanIdentityCard;

use ClawRock\ID3Global\Model\EuropeanIdentityCard\Mapper;
use ClawRock\ID3Global\Model\Values\InputData;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\EuropeanIdentityCard\Mapper
 */
class MapperTest extends TestCase
{
    /**
     * @var Mapper
     */
    protected $model;

    protected function setUp()
    {
        $this->model = $this->createObject(Mapper::class);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\EuropeanIdentityCard\Mapper::mapRequest
     */
    public function testMapRequest()
    {
        $this->assertInstanceOf(InputData::class, $this->model->mapRequest(new DataObject()));
    }
}
