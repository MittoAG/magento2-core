<?php

namespace Mitto\Core\Block\Adminhtml\System\Config\Form;

/**
 * Class Header
 */
class Header extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_layout
            ->createBlock(\Magento\Framework\View\Element\Template::class)
            ->setTemplate('Mitto_Core::system/config/header.phtml')
            ->setCacheable(false)
            ->toHtml();
    }

}