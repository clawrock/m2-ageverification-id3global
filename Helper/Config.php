<?php

namespace ClawRock\ID3Global\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    const ENABLED            = 'clawrock_id3global/general/active';
    const USERNAME           = 'clawrock_id3global/general/username';
    const PASSWORD           = 'clawrock_id3global/general/password';
    const PROFILE_ID         = 'clawrock_id3global/general/profile_id';
    const PROFILE_VERSION    = 'clawrock_id3global/general/profile_version';
    const CUSTOMER_REFERENCE = 'clawrock_id3global/general/customer_reference';
    const DEBUG_ENABLED      = 'clawrock_id3global/debug/enabled';
    const DEBUG_FILE         = 'clawrock_id3global/debug/file';
    const PILOT_ENABLED      = 'clawrock_id3global/debug/pilot_enabled';

    public function isEnabled($store = null): bool
    {
        return (bool) $this->scopeConfig->getValue(self::ENABLED, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getUsername($store = null): string
    {
        return $this->scopeConfig->getValue(self::USERNAME, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getPassword($store = null): string
    {
        return $this->scopeConfig->getValue(self::PASSWORD, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getProfileId($store = null): string
    {
        return $this->scopeConfig->getValue(self::PROFILE_ID, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getProfileVersion($store = null): int
    {
        return (int) $this->scopeConfig->getValue(self::PROFILE_VERSION, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getCustomerReference($store = null)
    {
        return $this->scopeConfig->getValue(self::CUSTOMER_REFERENCE, ScopeInterface::SCOPE_STORE, $store);
    }

    public function isDebugEnabled($store = null): bool
    {
        return (bool) $this->scopeConfig->getValue(self::DEBUG_ENABLED, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getDebugFile($store = null): string
    {
        return $this->scopeConfig->getValue(self::DEBUG_FILE, ScopeInterface::SCOPE_STORE, $store);
    }

    public function isPilotEnabled($store = null): bool
    {
        return (bool) $this->scopeConfig->getValue(self::PILOT_ENABLED, ScopeInterface::SCOPE_STORE, $store);
    }
}
