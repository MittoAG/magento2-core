<?php

namespace Mitto\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Mitto\Core\Helper
 */
class Config extends AbstractHelper
{
    /**
     * @param string $field
     * @return mixed
     */
    protected function getApiConfig($field)
    {
        return $this->scopeConfig->getValue(
            'mitto_core/api/' . $field,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getApiBaseUrl()
    {
        return $this->getApiConfig('base_url');
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->getApiConfig('key');
    }

    /**
     * @return string
     */
    public function getSender()
    {
        if ($this->getApiConfig('sender')) {
            return $this->getApiConfig('sender');
        }
        return $this->scopeConfig->getValue(
            \Magento\Store\Model\Information::XML_PATH_STORE_INFO_NAME,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array
     */
    public function getAdministratorNumbers()
    {
        return array_map(
            'trim',
            explode(',', $this->getApiConfig('administrator_numbers'))
        );
    }
}
