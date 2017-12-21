<?php

namespace ClawRock\ID3Global\Model\Webservice;

use ClawRock\AgeVerification\Api\Data\ResultInterface;
use ClawRock\ID3Global\Model\Request;

interface GatewayInterface
{
    public function authenticate(Request $request): ResultInterface;
}
