<?php

namespace Mitto\Core\Controller\Adminhtml\SMS;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

/**
 * Class Log
 * @package Mitto\Core\Controller\Adminhtml\SMS
 */
abstract class Log extends Action
{

    const ADMIN_RESOURCE = 'Mitto_Core::log';

    protected $_coreRegistry = null;

    /**
     * Log constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(Context $context, Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @param string $idFieldName
     * @return \Mitto\Core\Model\Log|mixed
     */
    protected function _initTemplate($idFieldName = 'id')
    {
        $id = (int)$this->getRequest()->getParam($idFieldName);
        $model = $this->_objectManager->create(\Mitto\Core\Model\Log::class);
        if ($id) {
            $model->load($id);
        }
        return $model;
    }
}
