<?php

namespace Mitto\Core\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mitto\Core\Model\Log;

/**
 * Class Collection
 * @package Mitto\Core\Model\ResourceModel\Log
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Log::class, \Mitto\Core\Model\ResourceModel\Log::class);
    }
}
