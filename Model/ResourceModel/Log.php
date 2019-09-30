<?php

namespace Mitto\Core\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Log
 * @package Mitto\Core\Model\ResourceModel
 */
class Log extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mitto_core_log', 'id');
    }
}
