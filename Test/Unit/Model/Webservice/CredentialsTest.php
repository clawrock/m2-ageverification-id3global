<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Webservice;

use ClawRock\ID3Global\Model\Webservice\Credentials;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Webservice\Credentials
 */
class CredentialsTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Webservice\Credentials::toSoapHeader
     */
    public function testToSoapHeader()
    {
        $credentials = new Credentials('username', 'password');

        $this->assertInstanceOf(\SoapHeader::class, $credentials->toSoapHeader());
    }
}
