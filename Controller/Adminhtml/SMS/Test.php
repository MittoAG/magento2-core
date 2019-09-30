<?php

namespace Mitto\Core\Controller\Adminhtml\SMS;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Mitto\Core\Model\Sender;

/**
 * Class Test
 * @package Mitto\Core\Controller\Adminhtml\SMS
 */
class Test extends Action
{

    const ADMIN_RESOURCE = 'Mitto_Core::mitto_core_menu';

    /**
     * @var Sender
     */
    private $sender;

    /**
     * Test constructor.
     * @param Context $context
     * @param Sender $sender
     */
    public function __construct(
        Context $context,
        Sender $sender
    ) {
        parent::__construct($context);
        $this->sender = $sender;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        /** @var Json $result */
        $result = $this->resultFactory->create(
            ResultFactory::TYPE_JSON
        );
        $to = $this->getRequest()->getParam('to');

        try {
            $response = $this->sender->send(
                $to,
                __('Test message')->render()
            );
            $result->setHttpResponseCode(200)->setData($response);
        } catch (Exception $e) {
            $result->setHttpResponseCode(500)->setData(['error' => $e->getMessage()]);
        }
        return $result;
    }
}
