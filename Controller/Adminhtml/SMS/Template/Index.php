<?php

namespace Mitto\Core\Controller\Adminhtml\SMS\Template;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Mitto\Core\Controller\Adminhtml\SMS\Template
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Mitto_Core::templates';

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
