<?php

namespace Mitto\Core\Controller\Adminhtml\SMS\Log;

use Mitto\Core\Controller\Adminhtml\SMS\Log;

/**
 * Class Grid
 * @package Mitto\Core\Controller\Adminhtml\SMS\Log
 */
class Grid extends Log
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
