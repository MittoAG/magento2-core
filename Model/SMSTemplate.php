<?php

namespace Mitto\Core\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Mitto\Core\Api\Data\SMSTemplateInterface;

/**
 * @method string|null getFrom()
 * @method string|null getTemplate()
 */
class SMSTemplate extends AbstractModel implements SMSTemplateInterface, IdentityInterface
{
    const CACHE_TAG = 'mitto_core_smstemplates';

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\SMSTemplate::class);
    }
}
