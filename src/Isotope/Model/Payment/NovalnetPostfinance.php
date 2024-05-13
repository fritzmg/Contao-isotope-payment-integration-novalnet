<?php

declare(strict_types=1);

/**
 * This file is part of the NovalnetGateway\IsotopeNovalnetBundle.
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

namespace NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment;

use Contao\CoreBundle\Exception\RedirectResponseException;
use Contao\Module;
use Contao\System;
use Isotope\Interfaces\IsotopePayment;
use Isotope\Interfaces\IsotopeProductCollection;
use Isotope\Interfaces\IsotopePurchasableCollection;
use Isotope\Model\Payment\Postsale;
use Isotope\Module\Checkout;
use Isotope\Model\ProductCollection\Order;
use NovalnetGateway\IsotopeNovalnetBundle\Helper\NovalnetHelper;
use NovalnetGateway\IsotopeNovalnetBundle\Callback\NovalnetWebHook;
use Symfony\Component\HttpFoundation\Request;
use Haste\Input\Input;

class NovalnetPostfinance extends Postsale implements IsotopePayment
{
    /**
     * @var NovalnetHelper
     */
    public $helper;

    /**
    * {@inheritdoc}
    */
    public function isAvailable()
    {
        $this->helper = new NovalnetHelper();

        if ($this->helper->validateGlobalConfig() == false) {
            return false;
        }

        return parent::isAvailable();
    }

    /**
     * This does not actually show a form.
     *
     * @throws RedirectResponseException
     */
    public function checkoutForm(IsotopeProductCollection $order, Module $module)
    {
        $this->helper = new NovalnetHelper();
        $data = $this->helper->buildNovalnetParams($order, $this->arrData['type']);
        $orderNo = $order->getDocumentNumber() ?: $order->getId();
        $data['transaction']['test_mode'] = !empty($this->novalnetpostfinanceTestMode) ? $this->novalnetpostfinanceTestMode : '0';
        $data['transaction']['hook_url'] = \Environment::get('base') . 'system/modules/isotope/postsale.php?mod=pay&id=' . $this->id.'&orderNo='.$orderNo;
        $data['transaction']['error_return_url'] = \Environment::get('base') . 'system/modules/isotope/postsale.php?mod=pay&id=' . $this->id.'&orderNo='.$orderNo;
        $response = $this->helper->sendCurlRequest('https://payport.novalnet.de/v2/seamless/payment', $data);

        if (!empty($response['result']['redirect_url']) && !empty($response['transaction']['txn_secret'])) {
            throw new RedirectResponseException($response['result']['redirect_url']);
        } else {
            $failedUrl = \Environment::get('base') . Checkout::generateUrlForStep(Checkout::STEP_FAILED).'?reason='.$response['result']['status_text'];
            throw new RedirectResponseException($failedUrl);
        }
    }

    /**
     * @inheritdoc
     */
    public function getPostsaleOrder()
    {
        return Order::findByPk((int) \Input::get('orderNo'));
    }

    /**
     * @inheritdoc
     */
    public function processPostsale(IsotopeProductCollection $objOrder)
    {
        if (!$objOrder instanceof IsotopePurchasableCollection) {
            \System::log('Product collection ID "' . $objOrder->getId() . '" is not purchasable', __METHOD__, TL_ERROR);
            return;
        }
        if (\Input::get('status_text') && \Input::get('status') == 'FAILURE') {
            $failedUrl = \Environment::get('base') . Checkout::generateUrlForStep(Checkout::STEP_FAILED);
            throw new RedirectResponseException($failedUrl.'?reason='.\Input::get('status_text'));
        } else {
            $this->webhook = new NovalnetWebHook();
            $eventData = json_decode(file_get_contents('php://input'), true);
            $this->webhook->handleProcessPostsale($eventData, $this->new_order_status, $objOrder);
        }
    }

    /**
     * @inheritdoc
     */
    public function processPayment(IsotopeProductCollection $objOrder, \Module $objModule)
    {
        $this->helper = new NovalnetHelper();
        $tid = \Input::get('tid');
        $status = \Input::get('status');
        $checkSum = \Input::get('checksum');
        $txnSecret = \Input::get('txn_secret');
        $this->helper->handleResponse($tid, $status, $checkSum, $txnSecret, $this->new_order_status, $objOrder);
        return true;
    }
}
