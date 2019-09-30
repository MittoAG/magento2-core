<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mitto\Core\Controller\Adminhtml\SMS\Template;

use Exception;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Mitto\Core\Controller\Adminhtml\SMS\Template;

/**
 * Rendering email template preview.
 */
class Preview extends Template implements HttpGetActionInterface
{
    /**
     * Preview transactional email action.
     *
     * @return void
     */
    public function execute()
    {
        try {
            $this->_view->loadLayout();
            $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Email Preview'));
            $this->_view->renderLayout();
            $this->getResponse()->setHeader('Content-Security-Policy', "script-src 'self'");
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred. The email template can not be opened for preview.')
            );
            $this->_redirect('adminhtml/*/');
        }
    }
}
