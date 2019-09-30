<?php

namespace Mitto\Core\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Mitto\Core\Api\Data\LogInterface;

/**
 * Class Log
 * @package Mitto\Core\Model
 */
class Log extends AbstractModel implements LogInterface, IdentityInterface
{
    const CACHE_TAG = 'mitto_core_log';

    protected function _construct()
    {
        $this->_init(ResourceModel\Log::class);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
