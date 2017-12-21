<?php

namespace ClawRock\ID3Global\Test\Unit\Model;

use ClawRock\AgeVerification\Model\Values\Dob;
use ClawRock\ID3Global\Model\Request;
use ClawRock\ID3Global\Model\Values\CustomerReference;
use ClawRock\ID3Global\Model\Values\InputData;
use ClawRock\ID3Global\Model\Values\Personal;
use ClawRock\ID3Global\Model\Values\Personal\Gender;
use ClawRock\ID3Global\Model\Values\Personal\Name;
use ClawRock\ID3Global\Model\Values\Profile;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Request
 */
class RequestTest extends TestCase
{
    /**
     * @var Request
     */
    protected $request;

    protected function setUp()
    {
        $profile = new Profile('profile_id', 1);
        $dob = new Dob(new \DateTime());
        $name = new Name('firstname', 'lastname');
        $gender = new Gender('Male');
        $personal = new Personal($dob, $name, $gender);
        $inputData = new InputData($personal);
        $this->request = new Request($profile, $inputData);
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Request::setCustomerReference
     */
    public function testSetCustomerReference()
    {
        $customerReference = new CustomerReference('customer_reference');
        $this->assertInstanceOf(Request::class, $this->request->setCustomerReference($customerReference));
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Request::toStdClass
     */
    public function testToStdClass()
    {
        $this->assertInstanceOf(\stdClass::class, $this->request->toStdClass());
    }
}
