<?php

namespace Mitto\Core\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Mitto\Core\Api\Data\LogInterface;

/**
 * Interface LogRepositoryInterface
 * @package Mitto\Core\Api
 */
interface LogRepositoryInterface
{
    /**
     * @param LogInterface $page
     * @return mixed
     */
    public function save(LogInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param LogInterface $page
     * @return mixed
     */
    public function delete(LogInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
