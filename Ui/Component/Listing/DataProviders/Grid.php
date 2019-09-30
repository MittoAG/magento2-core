<?php

namespace Mitto\Core\Ui\Component\Listing\DataProviders;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Mitto\Core\Model\ResourceModel\SMSTemplate\CollectionFactory;

/**
 * Class Grid
 * @package Mitto\Core\Ui\Component\Listing\DataProviders
 */
class Grid extends AbstractDataProvider
{
    /**
     * Grid constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
