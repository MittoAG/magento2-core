<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Mitto\Core\Controller\Adminhtml\SMS\Template;

use Mitto\Core\Controller\Adminhtml\SMS\Template;

/**
 * Class Grid
 * @package Mitto\Core\Controller\Adminhtml\SMS\Template
 */
class Grid extends Template
{
    /**
     * Grid action
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout(false);
        $this->_view->renderLayout();
    }
}
