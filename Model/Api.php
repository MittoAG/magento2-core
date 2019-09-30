<?php


namespace Mitto\Core\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Mitto\Core\Helper\Config;
use Zend_Http_Client;
use Zend_Http_Client_Exception;

/**
 * Class Api
 * @package Mitto\Core\Model
 */
class Api
{
    /**
     * @var ZendClientFactory
     */
    protected $_httpClientFactory;
    /**
     * @var Config
     */
    protected $configHelper;
    /**
     * @var Json
     */
    private $jsonSerializer;

    /**
     * Api constructor.
     * @param ZendClientFactory $httpClientFactory
     * @param Json $jsonSerializer
     * @param Config $configHelper
     */
    public function __construct(
        ZendClientFactory $httpClientFactory,
        Json $jsonSerializer,
        Config $configHelper
    ) {
        $this->_httpClientFactory = $httpClientFactory;
        $this->configHelper = $configHelper;
        $this->jsonSerializer = $jsonSerializer;
    }

    /**
     * @param $to
     * @param $message
     * @param null $from
     * @return array
     * @throws LocalizedException
     * @throws Zend_Http_Client_Exception
     */
    public function sendSMS($to, $message, $from = null)
    {
        return $this->call(
            'sms.json',
            [
                'from' => $from,
                'to'   => $to,
                'text' => $message,
                'type' => mb_check_encoding($message, "ASCII") ? null : 'Unicode',
            ],
            Zend_Http_Client::POST
        );
    }

    /**
     * @param string $endpoint
     * @param $params
     * @param string $method
     * @return array
     * @throws Zend_Http_Client_Exception
     * @throws LocalizedException
     */
    public function call($endpoint, $params, $method = Zend_Http_Client::GET)
    {
        $client = $this->_httpClientFactory->create();
        $client->setUri($this->configHelper->getApiBaseUrl() . $endpoint);
        $client->setMethod($method);
        $client->setHeaders(Zend_Http_Client::CONTENT_TYPE, 'application/json');
        $client->setHeaders('Accept', 'application/json');
        $client->setHeaders("X-Mitto-API-Key", $this->configHelper->getApiKey());
        $client->setParameterPost($params);
        $response = $client->request();
        switch ($response->getStatus()) {
            case 401:
                throw new LocalizedException(__('Unauthorized'));
        }
        $result = $this->jsonSerializer->unserialize($response->getBody());
        return $result;
    }

    /**
     * @param $responseCode
     * @throws LocalizedException
     */
    protected function validateResponseCode($responseCode)
    {
        switch ($responseCode) {
            case 0:
                break;
            case 1:
                throw new LocalizedException(__('Internal Error'));
            case 2:
                throw new LocalizedException(__('Invalid Type'));
            case 3:
                throw new LocalizedException(__('Empty message'));
            case 4:
                throw new LocalizedException(__('Message text is invalid'));
            case 5:
                throw new LocalizedException(__('Empty sender'));
            case 6:
                throw new LocalizedException(__('Invalid sender'));
            case 7:
                throw new LocalizedException(__('Empty receiver'));
            case 8:
                throw new LocalizedException(__('Invalid receiver'));
            case 9:
                throw new LocalizedException(__('Character set error'));
        }
    }
}
