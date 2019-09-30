<?php

namespace Mitto\Core\Controller\Adminhtml\SMS\Log;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Mitto\Core\Controller\Adminhtml\SMS\Log
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Mitto_Core::log';

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
