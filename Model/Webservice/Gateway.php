<?php

namespace ClawRock\ID3Global\Model\Webservice;

use ClawRock\AgeVerification\Api\Data\ResultInterface;
use ClawRock\ID3Global\Model\Request;
use ClawRock\ID3Global\Model\Result;

class Gateway implements GatewayInterface
{
    const LIVE = 'https://id3global.com/ID3gWS/ID3global.svc?wsdl';
    const PILOT = 'https://pilot.id3global.com/ID3gWS/ID3global.svc?wsdl';

    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var \Clawrock\ID3Global\Helper\Config
     */
    protected $config;

    public function __construct(
        \ClawRock\ID3Global\Helper\Config $config
    ) {
        $this->config = $config;
    }

    public function authenticate(Request $request): ResultInterface
    {
        return new Result($this->getClient()->AuthenticateSP($request->toStdClass()));
    }

    protected function getClient(): \SoapClient
    {
        if ($this->client === null) {
            $this->client = $this->prepareClient();
        }

        return $this->client;
    }

    protected function prepareClient(): \SoapClient
    {
        $options = [
            'exceptions' => true,
            'trace' => 1,
        ];

        $credentials = new Credentials($this->config->getUsername(), $this->config->getPassword());

        $client = new \SoapClient($this->getEndpoint(), $options);
        $client->__setSoapHeaders([$credentials->toSoapHeader()]);

        return $client;
    }

    protected function getEndpoint(): string
    {
        if ($this->config->isPilotEnabled()) {
            return self::PILOT;
        }

        return self::LIVE;
    }
}
