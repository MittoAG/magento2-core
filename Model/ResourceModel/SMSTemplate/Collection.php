<?php

namespace Mitto\Core\Model\ResourceModel\SMSTemplate;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mitto\Core\Model\ResourceModel\SMSTemplate;

/**
 * Class Collection
 * @package Mitto\Core\Model\ResourceModel\SMSTemplate
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Mitto\Core\Model\SMSTemplate::class, SMSTemplate::class);
        $this->_setIdFieldName('id');
    }

    /**
     * @param null $valueField
     * @param string $labelField
     * @param array $additional
     * @return array
     */
    protected function _toOptionArray($valueField = null, $labelField = 'title', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }

    /**
     * @param null $valueField
     * @param string $labelField
     * @return array
     */
    protected function _toOptionHash($valueField = null, $labelField = 'title')
    {
        return parent::_toOptionHash($valueField, $labelField);
    }
}
