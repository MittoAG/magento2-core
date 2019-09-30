<?php

namespace Mitto\Core\Model;

use Exception;
use Magento\Customer\Model\Data\Customer;
use Mitto\Core\Helper\Config;
use function json_encode;

/**
 * Class Sender
 * @package Mitto\Core\Model
 */
class Sender
{
    /**
     * @var Api
     */
    private $api;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var LogFactory
     */
    private $logFactory;

    /**
     * Sender constructor.
     * @param Api $api
     * @param Config $config
     * @param LogFactory $logFactory
     */
    public function __construct(Api $api, Config $config, LogFactory $logFactory)
    {
        $this->api = $api;
        $this->config = $config;
        $this->logFactory = $logFactory;
    }

    /**
     * @param $to
     * @param $text
     * @param null $from
     * @return array
     */
    public function send($to, $text, $from = null)
    {
        if (!$from) {
            $from = $this->config->getSender();
        }
        try {
            $log = $this->logFactory->create();
            $log->setData([
                'to'   => $to,
                'from' => $from,
                'text' => $text,
            ])->save();
            $response = $this->api->sendSMS(
                $to,
                $text,
                $from
            );
            $log->setData('response_serialized', json_encode($response));
            if (isset($response["id"])) {
                $log->setData('response_id', $response['id']);
            }
            $log->save();
            return $response;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * @param $message
     * @param null $from
     * @return array
     */
    public function notifyAdministrators($message, $from = null)
    {
        $responses = [];
        foreach ($this->config->getAdministratorNumbers() as $administratorNumber) {
            $responses[$administratorNumber] = $this->send($administratorNumber, $message, $from);
        }
        return $responses;
    }

    /**
     * @param Customer $customer
     * @param string $text
     * @param string $from
     * @return array
     */
    public function sendToCustomer($customer, $text, $from = null)
    {
        return $this->send(
            $this->extractNumberFromCustomer($customer),
            $text,
            $from
        );
    }

    /**
     * @param Customer $customer
     * @return string|null
     */
    protected function extractNumberFromCustomer($customer)
    {
        foreach ($customer->getAddresses() as $address) {
            if ($address->getTelephone()) {
                return $address->getTelephone();
            }
        }
    }
}
