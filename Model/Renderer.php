<?php

namespace Mitto\Core\Model;

use Exception;
use Magento\Email\Model\Template\FilterFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Mitto\Core\Api\SMSTemplateRepositoryInterface;

/**
 * Class Renderer
 * @package Mitto\Core\Model
 */
class Renderer
{
    /**
     * @var FilterFactory
     */
    private $filterFactory;
    /**
     * @var SMSTemplateRepositoryInterface
     */
    private $SMSTemplateRepository;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Renderer constructor.
     * @param FilterFactory $filterFactory
     * @param SMSTemplateRepositoryInterface $SMSTemplateRepository
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        FilterFactory $filterFactory,
        SMSTemplateRepositoryInterface $SMSTemplateRepository,
        StoreManagerInterface $storeManager
    ) {
        $this->filterFactory = $filterFactory;
        $this->SMSTemplateRepository = $SMSTemplateRepository;
        $this->storeManager = $storeManager;
    }

    /**
     * @param SMSTemplate|int $template
     * @param array $vars
     * @return string
     * @throws NoSuchEntityException
     */
    public function renderTemplate($template, $vars)
    {
        if (!$template instanceof SMSTemplate) {
            $template = $this->SMSTemplateRepository->getById($template);
        }
        $templateContent = $template->getTemplate();
        return $this->render($templateContent, $vars);
    }

    /**
     * @param string|null $templateContent
     * @param array $vars
     * @return string
     */
    public function render($templateContent, $vars)
    {
        $this->appendDefaultVars($vars);
        try {
            return $this->filterFactory->create()
                                       ->setVariables($vars)
                                       ->filter($templateContent);
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * @param $vars
     */
    protected function appendDefaultVars(&$vars)
    {
        if (!key_exists('store', $vars)) {
            try {
                $vars['store'] = $this->storeManager->getStore();
            } catch (NoSuchEntityException $e) {
            }
        }
    }
}
