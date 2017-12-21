<?php

namespace ClawRock\ID3Global\Model;

use ClawRock\AgeVerification\Api\Data\MethodInterface;
use ClawRock\AgeVerification\Api\Data\PersistableResultInterface;
use ClawRock\AgeVerification\Api\Data\ResultInterface;
use ClawRock\ID3Global\Model\Values\CustomerReference;
use ClawRock\ID3Global\Model\Values\Profile;
use Magento\Customer\Model\Customer;
use Magento\Framework\DataObject;

abstract class AbstractMethod implements MethodInterface
{
    const METHOD_TITLE = 'ID3Global';
    /**
     * @var \ClawRock\ID3Global\Helper\Config
     */
    protected $config;

    /**
     * @var \ClawRock\ID3Global\Model\Webservice\GatewayInterface
     */
    protected $gateway;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(
        \ClawRock\ID3Global\Helper\Config $config,
        \ClawRock\ID3Global\Model\Webservice\GatewayInterface $gateway,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->config = $config;
        $this->gateway = $gateway;
        $this->objectManager = $objectManager;
        $this->logger = $logger;
    }

    abstract protected function getInputDataMapper(): InputDataMapperInterface;

    public function authenticate(DataObject $request): ResultInterface
    {
        $request = new Request(
            $this->prepareProfile(),
            $this->prepareInputData($request),
            $this->prepareCustomerReference()
        );

        return $this->gateway->authenticate($request);
    }

    public function getTitle(): string
    {
        return static::METHOD_TITLE;
    }

    public function isCustomerAuthenticated(Customer $customer): bool
    {
        return $customer->getData(PersistableResultInterface::IS_VERIFIED_FIELD)
            && $customer->getData(PersistableResultInterface::TOKEN_FIELD)
            && $customer->getData(PersistableResultInterface::METHOD_FIELD);
    }

    public function isValid(): bool
    {
        return true;
    }

    private function prepareInputData(DataObject $request)
    {
        return $this->getInputDataMapper()->mapRequest($request);
    }

    private function prepareProfile(): Profile
    {
        return new Profile($this->config->getProfileId(), $this->config->getProfileVersion());
    }

    private function prepareCustomerReference(): CustomerReference
    {
        return new CustomerReference($this->config->getCustomerReference());
    }
}
