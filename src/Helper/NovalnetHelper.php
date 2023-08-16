<?php

declare(strict_types=1);


/**
 * Novalnet payment helper
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

namespace NovalnetGateway\IsotopeNovalnetBundle\Helper;

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
use NotificationCenter\Gateway\Email;
use NotificationCenter\Model\Notification;

class NovalnetHelper
{
    public $paymentType = array('novalnetsepa' => 'DIRECT_DEBIT_SEPA', 'novalnetcc' => 'CREDITCARD', 'novalnetinvoice' => 'INVOICE','novalnetprepayment' => 'PREPAYMENT','novalnetguaranteedinvoice' => 'GUARANTEED_INVOICE', 'novalnetguaranteedsepa' => 'GUARANTEED_DIRECT_DEBIT_SEPA', 'novalnetideal' => 'IDEAL', 'novalnetsofort' => 'ONLINE_TRANSFER', 'novalnetgiropay' => 'GIROPAY', 'novalnetbarzahlen' => 'CASHPAYMENT', 'novalnetprzelewy24' => 'PRZELEWY24', 'novalneteps' => 'EPS', 'novalnetinstalmentinvoice' => 'INSTALMENT_INVOICE', 'novalnetinstalmentsepa' => 'INSTALMENT_DIRECT_DEBIT_SEPA', 'novalnetpaypal' => 'PAYPAL', 'novalnetpostfinancecard' => 'POSTFINANCE_CARD', 'novalnetpostfinance' => 'POSTFINANCE', 'novalnetbancontact' => 'BANCONTACT', 'novalnetmultibanco' => 'MULTIBANCO');

    /**
     * Build Novalnet params
     *
     * @param  object $order
     * @param  string $paymentType
     *
     * @return array
     */
    public function buildNovalnetParams($order, $paymentType)
    {
        $request = array();
        $this->formVendorParameters($request);
        $this->formCustomerParameters($order, $request);
        $this->formTransactionParameters($order, $request, $paymentType);
        $this->formCustomParameters($request);
        $this->formMOTOFormParameters($request);
        return $request;
    }

    /**
     * Get Novalnet global configuration
     *
     * @param  string $column
     *
     * @return object
     */
    public function getNovalnetGlobalConfig($column)
    {
        $globalConfigValues = \Database::getInstance()->execute("SELECT {$column} FROM tl_iso_payment WHERE type='novalnetglobalconfig'");

        return $globalConfigValues;
    }

    /**
     * Form merchant details
     *
     * @param  array $request
     *
     * @return null
     */
    public function formVendorParameters(&$request)
    {
        $selectField = "novalnetglobalconfigActivationKey, novalnetglobalconfigTariffId";
        $config = $this->getNovalnetGlobalConfig($selectField);

        if (!empty($config->novalnetglobalconfigActivationKey) && !empty($config->novalnetglobalconfigTariffId)) {
            $request['merchant'] = array(
                'signature'          => $config->novalnetglobalconfigActivationKey,
                'tariff'             => $config->novalnetglobalconfigTariffId,
           );
        } else {
            throw new \RuntimeException('Invalid global configuration');
        }
    }

    /**
     * Form customer details
     *
     * @param  object $order
     * @param  array $request
     *
     * @return null
     */
    public function formCustomerParameters($order, &$request)
    {
        $objBillingAddress = $order->getBillingAddress();
        $objShippingAddress = $order->getShippingAddress();
        $request['customer'] = array(
            'first_name'        => $objBillingAddress->firstname,
            'last_name'         => $objBillingAddress->lastname,
            'customer_no'       => $order->member,
            'session'           => session_id(),
            'email'             => $objBillingAddress->email,
            'customer_ip'       => $_SERVER['REMOTE_ADDR'],
        );

        $request['customer']['billing'] = array(
           'street'            => $objBillingAddress->street_1,
              'city'              => $objBillingAddress->city,
              'zip'               => $objBillingAddress->postal,
              'country_code'      => strtoupper($objBillingAddress->country),
        );

        $request['customer']['shipping'] = array(
            'street'            => $objShippingAddress->street_1,
              'city'              => $objShippingAddress->city,
              'zip'               => $objShippingAddress->postal,
              'country_code'      => strtoupper($objShippingAddress->country),
        );
        if ($request['customer']['billing'] == $request['customer']['shipping']) {
            $request['customer']['shipping'] = array(
                'same_as_billing' => 1
            );
        } else {
            $request['customer']['shipping'] = array(
             'first_name' => $objShippingAddress->firstname,
             'last_name' => $objShippingAddress->lastname,
             'email' => $objShippingAddress->email,
             );
             if (!empty($objShippingAddress->company)) {
                $request['customer']['shipping']['company'] = $objShippingAddress->company;
            }
        }

        if ($objBillingAddress->gender === 'male') {
            $request['customer']['gender'] = 'm';
        } elseif ($objBillingAddress->gender === 'female') {
            $request['customer']['gender'] = 'f';
        } else {
            $request['customer']['gender'] = 'u';
        }

        if (!empty($objBillingAddress->street_2)) {
            $request['customer']['billing']['house_no'] = $objBillingAddress->street_2;
        }

        if (!empty($objBillingAddress->mobile)) {
            $request['customer']['mobile'] = $objBillingAddress->mobile;
        }

        if (!empty($objBillingAddress->phone)) {
            $request['customer']['tel'] = $objBillingAddress->phone;
        }

        if (!empty($objBillingAddress->fax)) {
            $request['customer']['fax'] = $objBillingAddress->fax;
        }

        if (!empty($objBillingAddress->company)) {
            $request['customer']['billing']['company'] = $objBillingAddress->company;
        }

        if (!empty($objBillingAddress->dateOfBirth)) {
            $request['customer']['birth_date'] = date('Y-m-d', (int)$objBillingAddress->dateOfBirth);
        }
    }

    /**
     * Form transaction details
     *
     * @param  object $order
     * @param  array $request
     * @param  string $currentPayment
     *
     * @return null
     */
    public function formTransactionParameters($order, &$request, $currentPayment)
    {
        $request['transaction'] = array(
          'payment_type'     => $this->paymentType[$currentPayment],
          'amount'           => number_format($order->getTotal(), 2, '.', '')*100,
          'currency'         => $order->getCurrency(),          
          'system_url'       => \Environment::get('base') ,
          'return_url'       => \Environment::get('base') . Checkout::generateUrlForStep(Checkout::STEP_COMPLETE, $order),
        );
    }

    /**
     * Form transaction details
     *
     * @param  array $request
     *
     * @return null
     */
    public function formCustomParameters(&$request)
    {
        global $objPage;
        $request['custom'] = array(
          'lang'        =>   $objPage->rootLanguage,
        );
    }

    /**
     * Form MOTO form details
     *
     * @param  array $request
     *
     * @return null
     */
    public function formMOTOFormParameters(&$request)
    {
        $request['hosted_page'] = array(
          'display_payments'    => [$request['transaction']['payment_type']],
          'hide_blocks'         => ['ADDRESS_FORM', 'SHOP_INFO', 'LANGUAGE_MENU', 'HEADER', 'TARIFF'],
          'skip_pages'          => ['CONFIRMATION_PAGE'],
        );
    }

    /**
     * preform curl call
     *
     * @param string $url
     * @param string $data
     *
     * @return array
     */
    public function sendCurlRequest($url, $data)
    {
        $config = $this->getNovalnetGlobalConfig('novalnetglobalconfigAccessKey');
        $encoded_data  = base64_encode($config->novalnetglobalconfigAccessKey);
        $options['headers'] = [
            'Content-Type' => 'application/json',
            'Charset' => 'utf-8',
            'Accept' => 'application/json',
            'X-NN-Access-Key' => $encoded_data
        ];
        $client = new \GuzzleHttp\Client($options);
        try {
            $response = $client->post($url, ['body' => json_encode($data)]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
        }
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Validate global configuration
     *
     * @return bool
     */
    public function validateGlobalConfig()
    {
        if (isset($_SESSION['novalnet']['error'])) {
            return false;
        }

        $globalConfigValues = \Database::getInstance()->execute("SELECT novalnetglobalconfigActivationKey, novalnetglobalconfigTariffId, novalnetglobalconfigAccessKey FROM tl_iso_payment WHERE type='novalnetglobalconfig' AND enabled=1");

        if (!empty($globalConfigValues->novalnetglobalconfigActivationKey) && !empty($globalConfigValues->novalnetglobalconfigTariffId) && $globalConfigValues->novalnetglobalconfigAccessKey) {
            return true;
        }
        return false;
    }

    /**
     * Check european country
     *
     * @param string $countryCode
     * @return bool
     */
    public function isEuropeanUnionCountry($countryCode)
    {
        $europeanUnionCountryCodes = [
            'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK',
            'EE', 'FI', 'FR', 'DE', 'EL', 'HU', 'IE',
            'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL',
            'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'UK', 'CH'
        ];

        return in_array($countryCode, $europeanUnionCountryCodes);
    }

    /**
     * check billing shipping address
     *
     * @return bool
     */
    public function checkShippingBillingAddress()
    {
        $objBillingAddress = Isotope::getCart()->getBillingAddress();
        $objShippingAddress = Isotope::getCart()->getShippingAddress();

        $billingAddress = [
            $objBillingAddress->street_1,
            $objBillingAddress->city,
            $objBillingAddress->postal,
            $objBillingAddress->country
        ];
        $shippingAddress = [
            $objShippingAddress->street_1,
            $objShippingAddress->city,
            $objShippingAddress->postal,
            $objShippingAddress->country
        ];

        return ($billingAddress === $shippingAddress);
    }

    /**
     * Get Guarantee payment error message
     *
     * @param object $order
     * @param int $minAmount
     * @param string $paymentType
     * 
     * @return string
     */
    public function getGuaranteeErrorMsg($order, $minAmount, $paymentType)
    {
        $objConfig = Isotope::getConfig();

        $objBillingAddress = Isotope::getCart()->getBillingAddress();
        $objShippingAddress = Isotope::getCart()->getShippingAddress();
        $countryCode = strtoupper($objBillingAddress->country);

        $guaranteeError = in_array($paymentType, array('novalnetguaranteedinvoice', 'novalnetguaranteedsepa')) ? specialchars($GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg']) . PHP_EOL : specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_error_msg']) . PHP_EOL;

        $errorMsg = '';

        $amount = number_format($order->getTotal(), 2)*100;

        if (!($amount >= $minAmount)) {
            $errorMsg .= PHP_EOL.sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_amount']), sprintf('%0.2f', $minAmount / 100));
        }
        if (!$this->isEuropeanUnionCountry($countryCode)) {
            $errorMsg .= PHP_EOL.specialchars($GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_country']);
        }
        if (!$this->checkShippingBillingAddress()) {
            $errorMsg .= PHP_EOL.specialchars($GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_address']);
        }
        if ($objConfig->currency != 'EUR') {
            $errorMsg .= PHP_EOL.specialchars($GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_currency']);
        }

        $errorMsg = $errorMsg ? $guaranteeError . $errorMsg : $errorMsg;

        return $errorMsg;
    }

    /**
     * Handle response
     *
     * @param $tid
     * @param $status
     * @param $checkSum
     * @param $txnSecret
     * @param $newOrderStatus
     * @param $order
     * @return null
     * @throws RedirectResponseException
     */
    public function handleResponse($tid, $status, $checkSum, $txnSecret, $newOrderStatus, $order)
    {
        $failedUrl = \Environment::get('base') . Checkout::generateUrlForStep(Checkout::STEP_FAILED);

        $config = $this->getNovalnetGlobalConfig('novalnetglobalconfigAccessKey');
        if (!empty($checkSum) && !empty($tid) && !empty($txnSecret) && !empty($status)) {
            $tokenString = $tid . $txnSecret . $status . strrev($config->novalnetglobalconfigAccessKey);
            $generatedChecksum = hash('sha256', $tokenString);
            if (hash_equals($generatedChecksum, $checkSum) == false) {
                throw new RedirectResponseException($failedUrl.'?reason='.specialchars($GLOBALS['TL_LANG']['MSC']['nn_checkhash_failed']));
            } else {
                $transactionData = $this->getTransactionDetails($tid);
                if ($transactionData['result']['status'] == 'SUCCESS') {                    
                    $comments = specialchars($GLOBALS['TL_LANG']['MSC']['nn_transaction_id']) .$transactionData['transaction']['tid'] . PHP_EOL;
                    $comments .= ($transactionData['transaction']['test_mode'] == '1') ? specialchars($GLOBALS['TL_LANG']['MSC']['nn_test_mode']) . PHP_EOL : '';

                    $paymentData = array(
                     'tid' => $transactionData['transaction']['tid'],
                     'status' => $transactionData['transaction']['status'],
                     'payment_type' => $transactionData['transaction']['payment_type'],
                     'amount' => $transactionData['transaction']['amount'],
                     'email' => $transactionData['customer']['email'],
                     'paid_amount' => in_array($transactionData['transaction']['payment_type'], array('INVOICE', 'PREPAYMENT', 'CASHPAYMENT', 'MULTIBANCO')) ? '0' : $transactionData['transaction']['amount'],
                    );

                    if (in_array($transactionData['transaction']['payment_type'], array('INSTALMENT_INVOICE', 'INSTALMENT_DIRECT_DEBIT_SEPA'))) {
                        $paymentData['instalment_details'] = $this->getInstalmentData($transactionData);
                    }

                    if (!empty($transactionData['transaction']['payment_data']['token'])) {
                        $paymentData['token'] = $transactionData['transaction']['payment_data']['token'];
                    }

                    if (!in_array($transactionData['transaction']['payment_type'], array('PREPAYMENT', 'CASHPAYMENT', 'MULTIBANCO'))  &&$transactionData['transaction']['status'] == 'PENDING') {
                        $orderStatus = '1';
                    } elseif ($transactionData['transaction']['status'] == 'ON_HOLD') {
                        $orderStatus = '4';
                    } else {
                        $orderStatus = $newOrderStatus;
                    }
                    $currentNotification    =   $order->nc_notification;
                    $order->nc_notification =   null;
                    $order->checkout();

                    $orderNo = $order->getDocumentNumber() ?: $order->getId();
                    $comments .= $this->prepareComments($transactionData, $orderNo);
                    $checkoutInfo       =   deserialize($order->checkout_info);
                    $checkoutInfo['payment_method']['info'] .= '<br>'.nl2br($comments);
                    $order->checkout_info   =   serialize($checkoutInfo);
                    $order->updateOrderStatus($orderStatus);

                    $transactionDetails['transaction'] = array(
                        'tid'      => $transactionData['transaction']['tid'],
                        'order_no' => $orderNo,
                    );
                    if (in_array($transactionData['transaction']['payment_type'], array('INVOICE', 'PREPAYMENT', 'GUARANTEED_INVOICE'))) {
                        $transactionDetails['transaction']['invoice_ref'] = 'BNR-' . $transactionData['merchant']['project'] . '-' . $orderNo;
                    }

                    $this->sendCurlRequest('https://payport.novalnet.de/v2/transaction/update', $transactionDetails);


                    $order->payment_data = json_encode($paymentData);
                    $order->save();
                    $this->sendNotification($order, $currentNotification);
                } else {
                    $message = $transactionData['result'];
                    $errorMessage = !empty($message['status_desc']) ? $message['status_desc'] : (!empty($message['status_text']) ? $message['status_text'] : (!empty($message['status_message']) ? $message['status_message'] : ''));
                    throw new RedirectResponseException($failedUrl.'?reason='.$errorMessage);
                }
            }
        } else {
            throw new RedirectResponseException($failedUrl.'?reason=Unauthorized access');
        }
    }

    /**
     * Sends Email Notification
     * @param object $order
     * @param int $currentNotification
     */
    public function sendNotification($order, $currentNotification)
    {
        $notificationIds = array_filter(explode(',', $currentNotification));

        // Send the notifications
        if (\count($notificationIds) > 0) {
            foreach ($notificationIds as $notificationId) {
                // Generate tokens
                $arrTokens = $order->getNotificationTokens($notificationId);

                // Send notification
                $blnNotificationError = true;

                /** @var Notification $objNotification */
                if (($objNotification = Notification::findByPk($notificationId)) !== null) {
                    $arrResult = $objNotification->send($arrTokens, $order->language);
                    if (\count($arrResult) > 0 && !\in_array(false, $arrResult, true)) {
                        $blnNotificationError = false;
                    }
                }

                if ($blnNotificationError === true) {
                    \System::log('Error sending new order notification for order ID ' . $order->id, __METHOD__, TL_ERROR);
                }
            }
        } else {
            \System::log('No notification for order ID ' . $this->id, __METHOD__, TL_ERROR);
        }
    }

    /**
     * Get transaction details
     *
     * @param int $tid
     * @return array
     */
    public function getTransactionDetails($tid)
    {
        $parameters['transaction'] = array('tid' => $tid);
        return $this->sendCurlRequest('https://payport.novalnet.de/v2/transaction/details', $parameters);
    }

    /**
     * Prepare payment status
     *
     * @param array $response
     * @param int $orderNo
     * @param string $guarantee
     * @return string
     */
    public function prepareComments($response, $orderNo, $guarantee='')
    {
        $comments = '';
        if (in_array($response['transaction']['payment_type'], array('GUARANTEED_DIRECT_DEBIT_SEPA', 'GUARANTEED_INVOICE', 'INSTALMENT_INVOICE', 'INSTALMENT_DIRECT_DEBIT_SEPA'))) {
            if (in_array($response['transaction']['payment_type'], array('GUARANTEED_DIRECT_DEBIT_SEPA', 'GUARANTEED_INVOICE')) && $guarantee == '') {
                $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_guarantee_payment']) . PHP_EOL;
            }
            if ($response['transaction']['status'] == 'PENDING') {
                $comments .= in_array($response['transaction']['payment_type'], array('GUARANTEED_INVOICE', 'INSTALMENT_INVOICE'))
                    ? specialchars($GLOBALS['TL_LANG']['MSC']['nn_invoice_guarantee_comment']).PHP_EOL
                    : specialchars($GLOBALS['TL_LANG']['MSC']['nn_sepa_guarantee_comment']). PHP_EOL;
            }
        }

        if (in_array($response['transaction']['payment_type'], array('INVOICE', 'PREPAYMENT')) || (in_array($response['transaction']['payment_type'], array('INSTALMENT_INVOICE', 'GUARANTEED_INVOICE')) && $response['transaction']['status'] != 'PENDING')) {
            $comments .= $this->prepareInvoiceComments($response, $orderNo);
        } elseif ($response['transaction']['payment_type'] == 'CASHPAYMENT') {
            $comments .= $this->prepareCashpaymentComments($response);
        } elseif ($response['transaction']['payment_type'] == 'MULTIBANCO') {
            $comments .= $this->prepareMultibancoComments($response);
        }
        if (in_array($response['transaction']['payment_type'], array('INSTALMENT_INVOICE', 'INSTALMENT_DIRECT_DEBIT_SEPA'))) {
            $comments .= $this->instalmentComments($response);
        }

        return $comments;
    }

    /**
     * Get instalment data.
     *
     * @param array $response
     *
     * @return array
     */
    public function getInstalmentData($response)
    {
        return  array('instalment'.$response['instalment']['cycles_executed'] => array(
                            'tid' => $response['transaction']['tid'],
                            'paid_date' => ($response['transaction']['status'] == 'CONFIRMED') ? date('d-m-Y') : '',
                            'next_instalment_date' => $response['instalment']['next_cycle_date'],
                             'instalment_cycles_executed' => $response['instalment']['cycles_executed'],
                            'due_instalment_cycles'      => $response['instalment']['pending_cycles'],
                            'amount'   => $response['transaction']['amount'],
                            ), 'instalment_cycles_executed' => $response['instalment']['cycles_executed'] );
    }

    /**
     * Prepare instalment comments
     *
     * @param array $response
     *
     * @return string
     */
    public function instalmentComments($response)
    {
        if (!empty($response['instalment']['next_cycle_date'])) {
            $comments = '';
            if ($response['transaction']['status'] == 'CONFIRMED') {                
                $comments .= PHP_EOL.specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_info']);
                $comments .= PHP_EOL . specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_processed']) . (!empty($response['instalment']['cycles_executed']) ? $response['instalment']['cycles_executed'] :  '');
                $comments .= PHP_EOL . specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_due']) . (isset($response['instalment']['pending_cycles']) ? $response['instalment']['pending_cycles'] :  '');
                
                $cycleAmount = !empty($response['instalment']['cycle_amount']) ? $response['instalment']['cycle_amount'] :  $response['transaction']['amount'];
                
                $amount = sprintf('%0.2f', $cycleAmount / 100). ' '.$response['transaction']['currency'];
                $comments .= PHP_EOL . specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_cycle_amount']) . $amount;

                if ($response['transaction']['payment_type'] == 'INSTALMENT_DIRECT_DEBIT_SEPA' && $response['instalment']['instalment_billing'] == '1') {
                    $comments .= PHP_EOL . PHP_EOL . sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_debit_text']), $response['transaction']['amount']);
                }
            }
            return $comments;
        }
    }

    /**
     * Prepare Invoice/Prepayment payment comments
     *
     * @param array $response
     * @param init $orderNo
     *
     * @return string
     */
    public function prepareInvoiceComments($response, $orderNo)
    {
        $invoice_ref = isset($response['transaction']['invoice_ref']) ? $response['transaction']['invoice_ref'] : 'BNR-'. $response['merchant']['project'].'-'. $orderNo;
        if (in_array($response['transaction']['status'], array('CONFIRMED', 'PENDING')) && !empty($response['transaction']['due_date'])) {
            $comments =  sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_order_note_due_date']), sprintf('%0.2f', $response['transaction']['amount'] / 100).' '. $response['transaction']['currency']  , date('d.m.Y', strtotime($response['transaction']['due_date']))). PHP_EOL;
        } else {
            $comments =  sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_order_note']), sprintf('%0.2f', $response['transaction']['amount'] / 100).' '. $response['transaction']['currency']). PHP_EOL;
        }

        $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_account_holder']) . $response['transaction']['bank_details']['account_holder'].PHP_EOL;
        $comments .= 'IBAN: ' . $response['transaction']['bank_details']['iban'].PHP_EOL;
        $comments .= 'BIC: ' . $response['transaction']['bank_details']['bic'].PHP_EOL;
        $comments .= 'Bank: ' . $response['transaction']['bank_details']['bank_name']. PHP_EOL;
        $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_bank_place']). $response['transaction']['bank_details']['bank_place']. PHP_EOL;
        if ($response['transaction']['payment_type'] == 'INSTALMENT_INVOICE') {
            $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_instalment_reference_note']).PHP_EOL;
            $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_payment_reference']). $response['transaction']['tid'] .PHP_EOL;
        } else {
            $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_reference_note']).PHP_EOL;
            $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_payment_reference_1']) . $invoice_ref .PHP_EOL;
            $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_payment_reference_2']) . $response['transaction']['tid'];
        }

        return $comments;
    }

    /**
     * Prepare Cashpayment comments
     *
     * @param array $response
     * @return string
     */
    public function prepareCashpaymentComments($response)
    {
        $comments = '';
        if (!empty($response['transaction']['due_date'])) {
            $comments .= sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_slip_exipry_date']), date('d.m.Y', strtotime($response['transaction']['due_date']))) . PHP_EOL;
        }
        $comments .= specialchars($GLOBALS['TL_LANG']['MSC']['nn_cashpayment_store']) . PHP_EOL;

        $data = json_decode(json_encode($response['transaction']['nearest_stores']), true);

        $nearestStoreCounts = count($data);

        for ($storePointer = 1; $storePointer <= $nearestStoreCounts; $storePointer++) {
            $comments .= $data[$storePointer]['store_name'] . ', ';
            $comments .= $data[$storePointer]['street'] . ', ';
            $comments .= $data[$storePointer]['city'] . ', ';
            $comments .= $data[$storePointer]['zip'] . ', ';
            $comments .= $data[$storePointer]['country_code'];
            $comments .= PHP_EOL;
        }

        return $comments;
    }

    /**
     * Prepare Multibanco comments
     *
     * @param array $response
     * @return string
     */
    public function prepareMultibancoComments($response)
    {
        $comments = sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_multibanco_comment']), sprintf('%0.2f', $response['transaction']['amount'] / 100), $response['transaction']['currency']) . PHP_EOL;
        $comments .= sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_multibanco_reference']), $response['transaction']['partner_payment_reference']) . PHP_EOL;
        $comments .= sprintf(specialchars($GLOBALS['TL_LANG']['MSC']['nn_multibanco_reference_entity']), $response['transaction']['service_supplier_id']) . PHP_EOL;

        return $comments;
    }
}
