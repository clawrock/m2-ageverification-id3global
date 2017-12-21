<?php

namespace ClawRock\ID3Global\Model;

use ClawRock\AgeVerification\Api\Data\PersistableResultInterface;
use ClawRock\AgeVerification\Exception\CustomerAuthenticationException;
use Magento\Customer\Model\Customer;

class Result implements PersistableResultInterface
{
    const BAND_TEXT_PASS = 'Pass';

    /**
     * @var bool
     */
    private $authorized = false;

    /**
     * @var string
     */
    private $token;

    public function __construct($rawResult)
    {
        $this->parseResult($rawResult->AuthenticateSPResult);

        if (!$this->isAuthorized()) {
            throw new CustomerAuthenticationException();
        }
    }

    public function isAuthorized(): bool
    {
        return $this->authorized;
    }

    public function persistInCustomerData(Customer $customer, string $method)
    {
        if (!$this->isAuthorized()) {
            return;
        }

        $customer->setData(self::IS_VERIFIED_FIELD, true);
        $customer->setData(self::METHOD_FIELD, $method);
        $customer->setData(self::TOKEN_FIELD, $this->token);
    }

    private function parseResult($result)
    {
        if ($this->authorized = (self::BAND_TEXT_PASS === $result->BandText)) {
            $this->token = $result->AuthenticationID;
        }
    }
}
