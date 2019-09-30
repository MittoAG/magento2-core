<?php

namespace Mitto\Core\Controller\Adminhtml\SMS;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Mitto\Core\Model\SMSTemplate;

/**
 * Class Template
 * @package Mitto\Core\Controller\Adminhtml\SMS
 */
abstract class Template extends Action
{

    const ADMIN_RESOURCE = 'Mitto_Core::template';

    protected $_coreRegistry = null;

    /**
     * Template constructor.
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
     * @return SMSTemplate|mixed
     */
    protected function _initTemplate($idFieldName = 'id')
    {
        $id = (int)$this->getRequest()->getParam($idFieldName);
        $model = $this->_objectManager->create(SMSTemplate::class);
        if ($id) {
            $model->load($id);
        }
        return $model;
    }
}
