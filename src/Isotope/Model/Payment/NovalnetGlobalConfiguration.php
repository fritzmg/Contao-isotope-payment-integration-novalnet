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
use Isotope\Model\Payment\Postsale;
use Isotope\Module\Checkout;
use Symfony\Component\HttpFoundation\Request;
use NovalnetGateway\IsotopeNovalnetBundle\Helper\NovalnetHelper;
use Haste\Input\Input;

class NovalnetGlobalConfiguration extends Postsale implements IsotopePayment
{
    /**
    * {@inheritdoc}
    */
    public function isAvailable()
    {
        global $objPage;
        if (!isset($_SESSION['novalnet']['error']) || (isset($_SESSION['novalnet']['error']) && $_SESSION['novalnet']['error'] != $this->novalnetglobalconfigActivationKey)) {
            $this->helper = new NovalnetHelper();
            $data = array(
              'merchant'    => array('signature' => $this->novalnetglobalconfigActivationKey),
              'custom'    => array('lang'      => $objPage->rootLanguage),
            );
            $response = $this->helper->sendCurlRequest('https://payport.novalnet.de/v2/merchant/details', $data);
            if ($response['result']['status'] == 'FAILURE') {
                $_SESSION['novalnet']['error'] = $this->novalnetglobalconfigActivationKey;
            } else {
                unset($_SESSION['novalnet']['error']);
            }
        }
        return false;
    }

    /**
    * {@inheritdoc}
    */
    public function getPostsaleOrder()
    {
        return true;
    }
    
    /**
    * {@inheritdoc}
    */
    public function processPostsale(IsotopeProductCollection $objOrder)
    {
        return true;
    }
}
