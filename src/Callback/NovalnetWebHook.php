<?php

declare(strict_types=1);


/**
 * Novalnet webhook
 *
 * This module is used for real time processing
 * of Novalnet transaction of customers.
 *
 * This free contribution made by request
 * If you have found this script useful a small
 * recommendation as well as a comment on merchant form
 * would be greatly appreciated
 *
 * @package Novalnet
 * @author Novalnet AG
 * @copyright Copyright by Novalnet
 * @license https://novalnet.de/payment-plugins/kostenlos/lizenz
 *
 */

namespace NovalnetGateway\IsotopeNovalnetBundle\Callback;

use Contao\File;
use Contao\CoreBundle\Exception\RedirectResponseException;
use Contao\Module;
use Contao\System;
use Isotope\Isotope;
use Isotope\Module\Checkout;
use Symfony\Component\HttpFoundation\Request;
use Isotope\Model\Payment\Postsale;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Haste\Input\Input;
use NovalnetGateway\IsotopeNovalnetBundle\Helper\NovalnetHelper;
use NotificationCenter\Gateway\Email;

class NovalnetWebHook
{
    /**
     * Allowed host from Novalnet.
     *
     * @var string
     */
    protected $novalnetHostName = 'pay-nn.de';

    /**
    * @var string
    */
    protected $eventType;

    /**
     * @var int
     */
    protected $orderStatus;

    /**
     * @var int
     */
    protected $parentTid;

    /**
     * @var int
     */
    protected $eventTid;

    /**
    * @var object
    */
    protected $orderReference;

    /**
     * @var int
     */
    protected $receivedAmount;

    /**
     * @var int
     */
    protected $orderId;

    /**
     * Mandatory Parameters.
     *
     * @var array
     */
    protected $mandatory = array(
        'event'       => array(
            'type',
            'checksum',
            'tid',
        ),
        'merchant'    => array(
            'vendor',
            'project',
        ),
        'result'      => array(
            'status',
        ),
        'transaction' => array(
            'tid',
            'payment_type',
            'status',
        ),
    );

    /* Handle callback process
     *
     * @param array $eventData
     * @param int $orderStatus
     * @param object $order
     * @return null
     */
    public function handleProcessPostsale($eventData, $orderStatus, $order)
    {
        $this->helper = new NovalnetHelper();
        $requestReceivedIp = $_SERVER['REMOTE_ADDR'];
        $this->eventData = $eventData;
        $config = $this->helper->getNovalnetGlobalConfig('novalnetglobalconfigWebhookTestMode');
        $novalnetHostIp  = gethostbyname($this->novalnetHostName);
        if (!empty($novalnetHostIp) && !empty($requestReceivedIp)) {
            if ($novalnetHostIp !== $requestReceivedIp && !$config->novalnetglobalconfigWebhookTestMode) {
                $this->displayMessage(['message' => 'Unauthorised access from the IP ' . $requestReceivedIp]);
            }
        } else {
            $this->displayMessage(['message' => 'Unauthorised access from the IP']);
        }

        // Get request parameters.
        $this->validateEventData();

        // Set Event data
        $this->eventType = $this->eventData['event']['type'];

        $this->orderStatus = $orderStatus;

        $this->parentTid = !empty($this->eventData['event']['parent_tid']) ? $this->eventData['event']['parent_tid'] : $this->eventData['event']['tid'];

        $this->eventTid  = $this->eventData['event']['tid'];

        if (!empty($this->eventData['result']['status']) && $this->eventData['result']['status'] == 'SUCCESS') {

            // Get order reference.
            $this->orderReference = $this->getOrderReference($order);

            $this->receivedAmount = sprintf('%0.2f', $this->eventData['transaction']['amount'] / 100);

            $this->orderId  = $this->eventData['transaction']['order_no'] ? $this->eventData['transaction']['order_no'] : $this->orderReference['order_no'];

            switch ($this->eventType) {
                case 'PAYMENT':
                    $this->displayMessage([ 'message' => 'The Payment has been received' ]);
                    break;

                case 'TRANSACTION_CAPTURE':
                case 'TRANSACTION_CANCEL':
                    $this->handleTransactionCaptureCancel($order);
                    break;
                case 'TRANSACTION_REFUND':
                    $this->handleTransactionRefund();
                    break;
                case 'TRANSACTION_UPDATE':
                    $this->handleTransactionUpdate($order);
                    break;
                case 'CREDIT':
                    $this->handleCredit($order);
                    break;
                case 'CHARGEBACK':
                    $this->handleChargeback();
                    break;
                case 'INSTALMENT':
                    $this->handleInstalment($order);
                    break;
            }
        }
    }

    /* Validate event data
     *
     * @return null
     */
    public function validateEventData()
    {
        // Validate required parameter
        foreach ($this->mandatory as $category => $parameters) {
            if (empty($this->eventData[$category])) {
                // Could be a possible manipulation in the notification data
                $this->displayMessage(['message' => "Required parameter category($category) not received" ]);
            } elseif (!empty($parameters)) {
                foreach ($parameters as $parameter) {
                    if (empty($this->eventData[$category][$parameter])) {
                        // Could be a possible manipulation in the notification data
                        $this->displayMessage(['message' => "Required parameter($parameter) in the category($category) not received"]);
                    } elseif (in_array($parameter, array('tid', 'parent_tid')) && !preg_match('/^\d{17}$/', (string) $this->eventData[$category][$parameter])) {
                        $this->displayMessage(['message' => "Invalid TID received in the category($category) not received $parameter"]);
                    }
                }
            }
        }

        // Validate the received checksum.
        $this->validateChecksum();

        // Validate TID's from the event data
        if (!preg_match('/^\d{17}$/', (string) $this->eventData['event']['tid'])) {
            $this->displayMessage(['message' => "Invalid event TID: " . $this->eventData['event']['tid'] . " received for the event(". $this->eventData['event']['type'] .")"]);
        } elseif ($this->eventData['event']['parent_tid'] && !preg_match('/^\d{17}$/', (string) $this->eventData['event']['parent_tid'])) {
            $this->displayMessage(['message' => "Invalid event TID: " . $this->eventData['event']['parent_tid'] . " received for the event(". $this->eventData['event']['type'] .")"]);
        }
    }

    /**
    * Validate checksum
    *
    * @return void
    */
    protected function validateChecksum()
    {
        $tokenString  = $this->eventData['event']['tid'] . $this->eventData['event']['type'] . $this->eventData['result']['status'];

        if (isset($this->eventData['transaction']['amount'])) {
            $tokenString .= $this->eventData['transaction']['amount'];
        }
        if (isset($this->eventData['transaction']['currency'])) {
            $tokenString .= $this->eventData['transaction']['currency'];
        }
        $config = $this->helper->getNovalnetGlobalConfig('novalnetglobalconfigAccessKey');
        if (!empty($config->novalnetglobalconfigAccessKey)) {
            $tokenString .= strrev($config->novalnetglobalconfigAccessKey);
        }
        $generatedChecksum = hash('sha256', $tokenString);
        if (hash_equals($generatedChecksum, $this->eventData['event']['checksum']) == false) {
            $this->displayMessage(['message' => "While notifying some data has been changed. The hash check failed"]);
        }
    }

    /**
    * Get order details
    *
    * @param object $order
    *
    * @return array
    */
    public function getOrderReference($order)
    {
        $paymentData = \Database::getInstance()->prepare("SELECT document_number, payment_data FROM tl_iso_product_collection WHERE id=?")->execute($order->getId());

        try {
            $unSerializeData = json_decode((string) $paymentData->payment_data, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $unSerializeData = [];
        }

        $unSerializeData['order_no'] = $order->getDocumentNumber() ?: $order->getId();
        $responseOrderNo = $this->eventData['transaction']['order_no'];

        if (!empty($responseOrderNo) && ($unSerializeData['order_no'] != $responseOrderNo)) {
            $this->displayMessage(['message' => "Order reference not matching"]);
        }

        return $unSerializeData;
    }

    /**
     * Handle transaction capture/cancel
     *
     * @param object $order
     *
     * @return null
     */
    public function handleTransactionCaptureCancel($order)
    {
        if ($this->eventType == 'TRANSACTION_CAPTURE') {
            $orderStatus = $this->orderStatus;
            $comments = PHP_EOL. PHP_EOL. sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_confirm']), date('Y-m-d H:i:s')).PHP_EOL;
            if (in_array($this->eventData['transaction']['payment_type'], array('INSTALMENT_INVOICE', 'INSTALMENT_DIRECT_DEBIT_SEPA'))) {
                $this->orderReference['instalment_details'] = $this->helper->getInstalmentData($this->eventData);
            }
            if (in_array($this->eventData['transaction']['payment_type'], array('INVOICE', 'GUARANTEED_INVOICE', 'INSTALMENT_INVOICE'))) {
                $comments .= sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transfer_amount']), $this->receivedAmount, $this->eventData['transaction']['currency'], $this->eventData['transaction']['due_date']).PHP_EOL;
            }
        } elseif ($this->eventType == 'TRANSACTION_CANCEL') {
            $comments = PHP_EOL.sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_cancel']), date('Y-m-d H:i:s')).PHP_EOL;
            $orderStatus = 5;
        }

        \Database::getInstance()->query(
            'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number=' . $this->orderId
        );
        $order->updateOrderStatus($orderStatus);
        $order->payment_data = json_encode($this->orderReference);
        $order->save();
        $this->sendWebhookMail($comments);
        $this->displayMessage(['message' => $comments]);
    }

    /**
     * Handle transaction refund
     *
     * @return null
     */
    public function handleTransactionRefund()
    {
        global $objPage;
        if (!empty($this->eventData['transaction']['refund']['amount'])) {
            $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_parent_tid']), $this->parentTid, $this->eventData['transaction']['refund']['amount'], $this->eventData['transaction']['refund']['currency']).PHP_EOL;

            if (!empty($this->eventData['transaction']['refund']['tid'])) {
                $commentsEn = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_child_tid']), $this->parentTid, $this->receivedAmount, $this->eventData['transaction']['refund']['currency'], $this->eventData['transaction']['refund']['tid'], sprintf('%0.2f', $this->eventData['transaction']['refund']['amount'] / 100), $this->eventData['transaction']['refund']['currency']).PHP_EOL;

                $commentsDe = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_child_tid']), $this->parentTid, $this->receivedAmount, $this->eventData['transaction']['refund']['currency'], sprintf('%0.2f', $this->eventData['transaction']['refund']['amount'] / 100), $this->eventData['transaction']['refund']['currency'], $this->eventData['transaction']['refund']['tid']).PHP_EOL;
                $comments = ($objPage->rootLanguage == 'de' ) ? $commentsDe : $commentsEn;
            }

            \Database::getInstance()->query(
                'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number ="' . $this->orderId . '"'
            );

            $this->sendWebhookMail($comments);
            $this->displayMessage(['message' => $comments]);
        }
    }

    /**
     * Handle transaction update
     *
     * @param object $order
     * @return null
     */
    public function handleTransactionUpdate($order)
    {
        if (in_array($this->eventData['transaction']['status'], array('PENDING', 'ON_HOLD', 'CONFIRMED', 'DEACTIVATED'))) {
            if ($this->eventData['transaction']['status']  == 'DEACTIVATED') {
                $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_cancel']), date('Y-m-d H:i:s')).PHP_EOL;
                $orderStatus = 5;
                \Database::getInstance()->query(
                    'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number ="' . $this->orderId . '"'
                );
            } else {
                if ($this->orderReference['status'] == 'PENDING' && $this->eventData['transaction']['status'] == 'ON_HOLD') {
                    $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_pending_to_onhold']), $this->eventTid, date('Y-m-d H:i:s')).PHP_EOL;
                    $this->orderReference['status'] = 'ON_HOLD';
                    if (in_array($this->orderReference['payment_type'], array('INSTALMENT_INVOICE', 'GUARANTEED_INVOICE'))) {
                        $comments .= $this->helper->prepareComments($this->eventData, $this->orderId, 'guarantee');
                    }
                    $orderStatus = 4;
                } elseif ($this->eventData['transaction']['status'] == 'CONFIRMED' && $this->orderReference['status'] != 'CONFIRMED') {
                    $orderStatus = $this->orderStatus;
                    if ($this->eventData['transaction']['payment_type'] == 'CASHPAYMENT') {
                        $comments = PHP_EOL.sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_cashpayment_transfer_update']), $this->receivedAmount.' ' .$this->eventData['transaction']['currency'], $this->eventData['transaction']['due_date']).PHP_EOL;
                    } else {
                        $comments = PHP_EOL. PHP_EOL. sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_confirm']), date('Y-m-d H:i:s')).PHP_EOL;
                    }

                    if (in_array($this->eventData['transaction']['payment_type'], array('GUARANTEED_INVOICE', 'GUARANTEED_DIRECT_DEBIT_SEPA')) && $this->orderReference['status'] == 'PENDING') {
                        $comments .= $this->helper->prepareComments($this->eventData, $this->orderId, 'guarantee');
                    }

                    if (in_array($this->orderReference['payment_type'], array('INSTALMENT_INVOICE', 'INSTALMENT_DIRECT_DEBIT_SEPA')) && isset($this->eventData['instalment'])) {
                        //instalment comments
                        $comments .= $this->helper->prepareComments($this->eventData, $this->orderId);
                        $this->orderReference['instalment_details'] = $this->helper->getInstalmentData($this->eventData);
                    }

                    if (!empty($this->eventData['transaction']['due_date']) && in_array($this->eventData['transaction']['payment_type'], ['INVOICE', 'PREPAYMENT', 'GUARANTEED_INVOICE', 'INSTALMENT_INVOICE'])) {
                        $comments .= PHP_EOL.sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_transfer_update']), $this->receivedAmount, $this->eventData['transaction']['currency'], $this->eventData['transaction']['due_date']).PHP_EOL;
                    }
                }
            }

            \Database::getInstance()->query(
                'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number ="' . $this->orderId . '"'
            );
            $order->updateOrderStatus($orderStatus);
            $order->payment_data = json_encode($this->orderReference);
            $order->save();
            $this->sendWebhookMail($comments);
            $this->displayMessage(['message' => $comments]);
        }
    }

    /**
    * Handle Credit event
    *
    * @param object $order
    * @return null
    */
    public function handleCredit($order)
    {
        if ($this->eventData['transaction']['payment_type'] == 'ONLINE_TRANSFER_CREDIT') {
            $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_online_transfer_credit']), $this->parentTid, $this->receivedAmount, date('Y-m-d H:i:s'), $this->eventTid).PHP_EOL;
        } else {
            $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_credit']), $this->parentTid, $this->receivedAmount, date('d-m-Y'), $this->eventTid).PHP_EOL;

            if (in_array($this->eventData['transaction']['payment_type'], array('INVOICE_CREDIT', 'CASHPAYMENT_CREDIT', 'MULTIBANCO_CREDIT' ))) {
                $amountAlreadyPaid = $this->orderReference['paid_amount'];

                if ($amountAlreadyPaid < $this->orderReference['amount']) {
                    $totalPaidAmount = $amountAlreadyPaid + $this->eventData['transaction']['amount'];
                    $this->orderReference['paid_amount'] = $totalPaidAmount;
                    if (((int) $totalPaidAmount >= (int) $amountAlreadyPaid)) {
                        $statusStatus = ($this->orderReference['payment_type'] == 'CASHPAYMENT') ? 'novalnetbarzahlenCallbackOrderStatus' : 'novalnet'.strtolower($this->orderReference['payment_type']).'CallbackOrderStatus';

                        $paymentType = ($this->orderReference['payment_type'] == 'CASHPAYMENT') ? 'novalnetbarzahlen' : 'novalnet'.strtolower($this->orderReference['payment_type']);
                        $callbackOrderStatus = \Database::getInstance()->execute("SELECT {$statusStatus} FROM tl_iso_payment WHERE type='$paymentType' AND enabled=1");
                        $order->updateOrderStatus($callbackOrderStatus->$statusStatus);
                        $order->payment_data = json_encode($this->orderReference);
                        $order->save();
                    }
                }
            }
        }

        \Database::getInstance()->query(
            'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number ="' . $this->orderId . '"'
        );

        $this->sendWebhookMail($comments);
        $this->displayMessage(['message' => $comments]);
    }

    /**
      * Handle transaction chargeback event
      *
      * @return null
      */
    public function handleChargeback()
    {
        if ($this->orderReference['status'] == 'CONFIRMED' && !empty($this->eventData['transaction']['amount'])) {
            $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_webhook_chargeback']), $this->parentTid, $this->receivedAmount, date('d-m-Y'), date('H:i:s'), $this->eventTid).PHP_EOL;
            \Database::getInstance()->query(
                'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number ="' . $this->orderId . '"'
            );
            $this->sendWebhookMail($comments);
            $this->displayMessage(['message' => $comments]);
        }
    }

    /**
     * Handle instalment cycles
     *
     * @param object $order
     *
     * @return null
     */
    public function handleInstalment($order)
    {
        if ($this->eventData['transaction']['status'] == 'CONFIRMED' && !empty($this->eventData['instalment']['cycles_executed'])) {
            $comments = PHP_EOL.sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_received']), $this->parentTid, $this->receivedAmount, date('d-m-Y'), $this->eventTid);

            $this->orderReference['instalment_details'] = array_merge($this->orderReference['instalment_details'], ['instalment'.$this->eventData['instalment']['cycles_executed'] => [
                            'tid' => $this->eventTid,
                            'paid_date' => date('d-m-Y'),
                            'next_instalment_date' => $this->eventData['instalment']['next_cycle_date'],
                             'instalment_cycles_executed' => $this->eventData['instalment']['cycles_executed'],
                            'due_instalment_cycles'      => $this->eventData['instalment']['pending_cycles'],
                            'amount'   => $this->receivedAmount
                            ], 'instalment_cycles_executed' => $this->eventData['instalment']['cycles_executed'] ]);
            $comments .= PHP_EOL . PHP_EOL . $this->helper->prepareComments($this->eventData, $this->orderId);

            \Database::getInstance()->query(
                'UPDATE tl_iso_product_collection SET notes = CONCAT(IF(notes IS NULL, "", notes), "' . $comments . '") WHERE document_number ="' . $this->orderId . '"'
            );
            $this->sendWebhookMail($comments);
            $this->displayMessage(['message' => $comments]);
            $order->payment_data = json_encode($this->orderReference);
            $order->save();
        }
    }

    /**
     * Display the callback message
     *
     * @param string $message
     *
     * @return null
     */
    public function displayMessage($message)
    {
        print(json_encode($message));
        exit;
    }

    /**
     * Send notify email after callback process
     *
     * @param string $message
     * @return bool
     */
    public function sendWebhookMail($message)
    {
        $config = $this->helper->getNovalnetGlobalConfig("novalnetglobalconfigWebHookSendMail");
        if ($config->novalnetglobalconfigWebHookSendMail) {
            $objEmail = new \Email();
            $objEmail->fromName = $GLOBALS['TL_ADMIN_NAME'];
            $objEmail->from =  $GLOBALS['TL_ADMIN_EMAIL'];
            $objEmail->subject = 'Novalnet Callback script notification - Order No : ' . $this->orderId;
            $objEmail->html     = $message;
            try {
                return $objEmail->sendTo($config->novalnetglobalconfigWebHookSendMail);
            } catch (\Exception $e) {
                \System::log(sprintf('Could not send email for message ID %s: %s', $this->orderId, $e->getMessage()), __METHOD__, TL_ERROR);
            }
        }
    }
}
