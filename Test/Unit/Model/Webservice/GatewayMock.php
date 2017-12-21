<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Webservice;

use ClawRock\ID3Global\Model\Webservice\Gateway;

class GatewayMock extends Gateway
{
    public function setClient(\SoapClient $client)
    {
        $this->client = $client;

        return $this;
    }
}
