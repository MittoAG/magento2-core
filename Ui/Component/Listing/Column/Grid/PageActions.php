<?php

namespace Mitto\Core\Ui\Component\Listing\Column\Grid;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class PageActions
 * @package Mitto\Core\Ui\Component\Listing\Column\Grid
 */
class PageActions extends Column
{
    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = null;
                if (isset($item["id"])) {
                    $id = $item["id"];
                }
                $item[$name]["view"] = [
                    "href"  => $this->getContext()->getUrl(
                        "adminhtml/sms_template/edit",
                        ["id" => $id]
                    ),
                    "label" => __("Edit"),
                ];
            }
        }

        return $dataSource;
    }
}
