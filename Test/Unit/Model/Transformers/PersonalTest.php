<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Transformers;

use ClawRock\AgeVerification\Model\Transformers\Dob;
use ClawRock\AgeVerification\Model\Values\Dob as DobValue;
use ClawRock\ID3Global\Model\Transformers\Personal;
use ClawRock\ID3Global\Model\Transformers\Personal\Gender;
use ClawRock\ID3Global\Model\Transformers\Personal\Name;
use ClawRock\ID3Global\Model\Values\Personal\Gender as GenderValue;
use ClawRock\ID3Global\Model\Values\Personal\Name as NameValue;
use ClawRock\MagentoTesting\TestCase;
use Magento\Framework\DataObject;

/**
 * @covers \ClawRock\ID3Global\Model\Transformers\Personal
 */
class PersonalTest extends TestCase
{
    /**
     * @var Dob|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $dobMock;

    /**
     * @var Name|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $nameMock;

    /**
     * @var Gender|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $genderMock;

    /**
     * @var Personal
     */
    protected $model;

    protected function setUp()
    {
        $this->dobMock = $this->getMockBuilder(Dob::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->nameMock = $this->getMockBuilder(Name::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->genderMock = $this->getMockBuilder(Gender::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = $this->createObject(Personal::class, [
            'dob' => $this->dobMock,
            'name' => $this->nameMock,
            'gender' => $this->genderMock,
        ]);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Transformers\Personal::transform
     */
    public function testTransform()
    {
        $this->dobMock->expects($this->once())
            ->method('transform')
            ->willReturn(new DobValue(new \DateTime('1990-01-01')));

        $this->nameMock->expects($this->once())
            ->method('transform')
            ->willReturn(new NameValue('firstname', 'lastname', 'title'));

        $this->genderMock->expects($this->once())
            ->method('transform')
            ->willReturn(new GenderValue('Male'));

        $expected = (object) [
            'PersonalDetails' => (object) [
                'Gender'   => 'Male',
                'Title'    => 'title',
                'Forename' => 'firstname',
                'Surname'  => 'lastname',
                'DOBDay'   => 1,
                'DOBMonth' => 1,
                'DOBYear'  => 1990,
            ],
        ];

        $this->assertEquals($expected, $this->model->transform(new DataObject())->toStdClass());
    }
}
