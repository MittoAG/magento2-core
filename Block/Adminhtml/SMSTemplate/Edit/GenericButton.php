<?php

namespace Mitto\Core\Block\Adminhtml\SMSTemplate\Edit;

use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 * @package Mitto\Core\Block\Adminhtml\SMSTemplate\Edit
 */
class GenericButton
{

    /**
     * @var Context
     */
    private $context;

    /**
     * GenericButton constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getObjectId()]);
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->context->getRequest()->getParam('id');
    }
}
