<?php

namespace Mitto\Core\Controller\Adminhtml\SMS\Template;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Mitto\Core\Model\SMSTemplateRepository;

/**
 * Class Delete
 * @package Mitto\Core\Controller\Adminhtml\SMS\Template
 */
class Delete extends Action
{
    const ADMIN_RESOURCE = 'Mitto_Core::templates';

    /**
     * @var SMSTemplateRepository
     */
    protected $objectRepository;

    /**
     * Delete constructor.
     * @param SMSTemplateRepository $objectRepository
     * @param Context $context
     */
    public function __construct(
        SMSTemplateRepository $objectRepository,
        Context $context
    ) {
        $this->objectRepository = $objectRepository;

        parent::__construct($context);
    }

    /**
     * @return Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->objectRepository->deleteById($id);
                $this->messageManager->addSuccess(__('You have deleted the object.'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can not find an object to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
