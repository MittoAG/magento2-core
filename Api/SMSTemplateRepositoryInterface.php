<?php

namespace Mitto\Core\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Mitto\Core\Api\Data\SMSTemplateInterface;
use Mitto\Core\Model\SMSTemplate;

/**
 * Interface SMSTemplateRepositoryInterface
 * @package Mitto\Core\Api
 */
interface SMSTemplateRepositoryInterface
{
    /**
     * @param SMSTemplateInterface $page
     * @return mixed
     */
    public function save(SMSTemplateInterface $page);

    /**
     * @param $id
     * @return SMSTemplate
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param SMSTemplateInterface $page
     * @return mixed
     */
    public function delete(SMSTemplateInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
