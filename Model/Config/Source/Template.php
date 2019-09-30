<?php

namespace Mitto\Core\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Mitto\Core\Model\ResourceModel\SMSTemplate\CollectionFactory;

/**
 * Class Template
 * @package Mitto\Core\Model\Config\Source
 */
class Template implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $templateCollectionFactory;

    protected $_options;

    /**
     * Template constructor.
     * @param CollectionFactory $templateCollectionFactory
     */
    public function __construct(CollectionFactory $templateCollectionFactory
    ) {

        $this->templateCollectionFactory = $templateCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = array_merge(
                [
                    [
                        'value' => 0,
                        'label' => 'None',
                    ],
                ],
                $this->templateCollectionFactory->create()->toOptionArray()
            );
        }
        return $this->_options;
    }
}
