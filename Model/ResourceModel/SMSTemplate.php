<?php

namespace Mitto\Core\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class SMSTemplate
 * @package Mitto\Core\Model\ResourceModel
 */
class SMSTemplate extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mitto_core_smstemplates', 'id');
    }
}
