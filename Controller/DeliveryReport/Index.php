<?php

namespace Mitto\Core\Controller\DeliveryReport;

use InvalidArgumentException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Mitto\Core\Model\LogRepository;

/**
 * Class Index
 * @package Mitto\Core\Controller\DeliveryReport
 */
class Index extends Action implements CsrfAwareActionInterface
{
    /**
     * @var JsonSerializer
     */
    private $jsonSerializer;
    /**
     * @var LogRepository
     */
    private $logRepository;

    /**
     * Index constructor.
     * @param Context $context
     * @param JsonSerializer $jsonSerializer
     * @param LogRepository $logRepository
     */
    public function __construct(
        Context $context,
        JsonSerializer $jsonSerializer,
        LogRepository $logRepository
    ) {
        parent::__construct($context);
        $this->jsonSerializer = $jsonSerializer;
        $this->logRepository = $logRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $data = $this->jsonSerializer->unserialize($this->getRequest()->getContent());
            $log = $this->logRepository->getByMessageId($data['msgid']);
            $log->setStatus($data['status']);
            $this->logRepository->save($log);
            $result->setHttpResponseCode(200);
        } catch (LocalizedException $e) {
            $result->setHttpResponseCode(500);
        } catch (InvalidArgumentException $e) {
            $result->setHttpResponseCode(500);
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(
        RequestInterface $request
    ): ?InvalidRequestException {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
}
