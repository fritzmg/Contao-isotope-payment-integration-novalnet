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

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetglobalconfigActivationKey' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetglobalconfigActivationKey'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "varchar(255) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetglobalconfigTariffId' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetglobalconfigTariffId'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "varchar(20) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetglobalconfigAccessKey' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetglobalconfigAccessKey'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "varchar(255) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetglobalconfigWebhookTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetglobalconfigWebhookTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetglobalconfigWebHookSendMail' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetglobalconfigWebHookSendMail'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "varchar(255) NULL ",
    ]
]);

// Direct Debit SEPA
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetsepaTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetsepaTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetsepaDueDate' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetsepaDueDate'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetsepaOneClickShopping' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetsepaOneClickShopping'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetsepaPaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetsepaPaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetsepaOnHoldLimit' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetsepaOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// Credit Card
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetccTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetccTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetccOneClickShopping' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetccOneClickShopping'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetccPaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetccPaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetccOnHoldLimit' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetccOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// Invoice
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinvoiceTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinvoiceTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinvoiceDueDate' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinvoiceDueDate'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinvoicePaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinvoicePaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinvoiceOnHoldLimit' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinvoiceOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinvoiceCallbackOrderStatus' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinvoiceCallbackOrderStatus'],
        'exclude' => true,
        'inputType'  => 'select',
        'foreignKey'  => \Isotope\Model\OrderStatus::getTable().'.name',
        'options_callback' => array('\Isotope\Backend', 'getOrderStatus'),
        'eval'            => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
         'sql'            => "int(10) NOT NULL default '0'",
    ]
]);

// Prepayment
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetprepaymentTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetprepaymentTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetprepaymentCallbackOrderStatus' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetprepaymentCallbackOrderStatus'],
        'exclude' => true,
        'inputType'  => 'select',
        'foreignKey'            => \Isotope\Model\OrderStatus::getTable().'.name',
        'options_callback'      => array('\Isotope\Backend', 'getOrderStatus'),
        'eval'                  => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                   => "int(10) NOT NULL default '0'",
    ]
]);

// Guaranteed Invoice
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedinvoiceTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedinvoiceTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedinvoicePaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedinvoicePaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedinvoiceOnHoldLimit' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedinvoiceOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedinvoiceForceNonGuarantee' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedinvoiceForceNonGuarantee'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedinvoiceAllowB2B' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedinvoiceAllowB2B'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedinvoiceMinimumOrderamount' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedinvoiceMinimumOrderamount'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// Guaranteed Direct Debit SEPA
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaOneClickShopping' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaOneClickShopping'],
       'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaPaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaPaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaOnHoldLimit' => [
         'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaForceNonGuarantee' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaForceNonGuarantee'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaAllowB2B' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaAllowB2B'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetguaranteedsepaMinimumOrderamount' => [
         'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetguaranteedsepaMinimumOrderamount'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// iDEAL
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetidealTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetidealTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// Sofort
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetsofortTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetsofortTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// giropay
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetgiropayTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetgiropayTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// Barzahlen
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetbarzahlenTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetbarzahlenTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetbarzahlenSlipExpiryDate' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetbarzahlenSlipExpiryDate'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetbarzahlenCallbackOrderStatus' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetbarzahlenCallbackOrderStatus'],
        'exclude' => true,
        'inputType'  => 'select',
        'foreignKey'            => \Isotope\Model\OrderStatus::getTable().'.name',
        'options_callback'      => array('\Isotope\Backend', 'getOrderStatus'),
        'eval'                  => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                   => "int(10) NOT NULL default '0'",
    ]
]);

// Przelewy24
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetprzelewy24TestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetprzelewy24TestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// eps
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetepsTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetepsTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// Instalment by Invoice
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentinvoiceTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentinvoiceTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentinvoicePaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentinvoicePaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentinvoiceOnHoldLimit' => [
         'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentinvoiceOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentinvoiceAllowB2B' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentinvoiceAllowB2B'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentinvoiceMinimumOrderAmount' => [
         'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentinvoiceMinimumOrderAmount'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// Instalment by Direct Debit SEPA
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentsepaTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentsepaTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentsepaOneClickShopping' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentsepaOneClickShopping'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentsepaPaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentsepaPaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentsepaOnHoldLimit' => [
         'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentsepaOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentsepaAllowB2B' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentsepaAllowB2B'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '1'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetinstalmentsepaMinimumOrderAmount' => [
         'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetinstalmentsepaMinimumOrderAmount'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// PayPal
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetpaypalTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetpaypalTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetpaypalOneClickShopping' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetpaypalOneClickShopping'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetpaypalPaymentAction' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetpaypalPaymentAction'],
        'exclude' => true,
        'default'  => 'capture',
        'inputType' => 'select',
        'options'  => array('capture', 'authorize'),
        'eval'    => array('mandatory'=>false, 'tl_class'=>'w50'),
        'sql'     => "varchar(10) NOT NULL default ''",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetpaypalOnHoldLimit' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetpaypalOnHoldLimit'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "int(10) NULL ",
    ]
]);

// Postfinance card
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetpostfinancecardTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetpostfinancecardTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// Postfinance
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetpostfinanceTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetpostfinanceTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// Bancontact
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetbancontactTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetbancontactTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);

// Multibanco
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetmultibancoTestMode' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetmultibancoTestMode'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "char(1) NULL default '0'",
    ]
]);
$GLOBALS['TL_DCA']['tl_iso_payment']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_iso_payment']['fields'], [
    'novalnetmultibancoCallbackOrderStatus' => [
        'label' => &$GLOBALS['TL_LANG']['tl_iso_payment']['novalnetmultibancoCallbackOrderStatus'],
        'exclude' => true,
        'inputType'  => 'select',
        'foreignKey'  => \Isotope\Model\OrderStatus::getTable().'.name',
        'options_callback' => array('\Isotope\Backend', 'getOrderStatus'),
        'eval'            => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
         'sql'            => "int(10) NOT NULL default '0'",
    ]
]);

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetglobalconfig'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetsepa'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetcc'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetinvoice'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetprepayment'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetguaranteedinvoice'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetguaranteedsepa'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetideal'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetsofort'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetgiropay'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetbarzahlen'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetprzelewy24'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalneteps'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetinstalmentinvoice'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetinstalmentsepa'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetpaypal'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetpostfinancecard'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetpostfinance'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetbancontact'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];
$GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['novalnetmultibanco'] = $GLOBALS['TL_DCA']['tl_iso_payment']['palettes']['cash'];

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetglobalconfigActivationKey', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetglobalconfigTariffId', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetglobalconfigAccessKey', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetglobalconfigWebhookTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)    
    ->addField('novalnetglobalconfigWebHookSendMail', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->removeField('note', 'note_legend')
    ->removeField('new_order_status', 'config_legend')
    ->removeField('quantity_mode', 'config_legend')
    ->removeField('minimum_quantity', 'config_legend')
    ->removeField('maximum_quantity', 'config_legend')
    ->removeField('minimum_total', 'config_legend')
    ->removeField('maximum_total', 'config_legend')
    ->removeField('countries', 'config_legend')
    ->removeField('shipping_modules', 'config_legend')
    ->removeField('product_types', 'config_legend')
    ->removeField('product_types_condition', 'config_legend')
    ->removeField('config_ids', 'config_legend')
    ->removeField('price', 'price_legend')
    ->removeField('tax_class', 'price_legend')
    ->removeField('guests', 'expert_legend')
    ->removeField('protected', 'expert_legend')
    ->applyToPalette('novalnetglobalconfig', 'tl_iso_payment');
    
// Direct Debit SEPA
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetsepaTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetsepaDueDate', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetsepaOneClickShopping', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetsepaPaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetsepaOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetsepa', 'tl_iso_payment');
    
// Credit card
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetccTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetccOneClickShopping', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetccPaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetccOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetcc', 'tl_iso_payment');
// Invoice
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetinvoiceTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinvoiceDueDate', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinvoicePaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinvoiceOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinvoiceCallbackOrderStatus', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetinvoice', 'tl_iso_payment');
    
// Prepayment
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)    
    ->addField('novalnetprepaymentTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)    
    ->addField('novalnetprepaymentCallbackOrderStatus', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetprepayment', 'tl_iso_payment');
 
// Guarantee Invoice
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetguaranteedinvoiceTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedinvoicePaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedinvoiceOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedinvoiceForceNonGuarantee', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedinvoiceAllowB2B', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedinvoiceMinimumOrderamount', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetguaranteedinvoice', 'tl_iso_payment');
  
// Guaranteed SEPA
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetguaranteedsepaTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedsepaOneClickShopping', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)    
    ->addField('novalnetguaranteedsepaPaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedsepaForceNonGuarantee', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedsepaOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedsepaMinimumOrderamount', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetguaranteedsepaAllowB2B', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetguaranteedsepa', 'tl_iso_payment');
   
// iDEAL
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetidealTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetideal', 'tl_iso_payment');

// Sofort
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetsofortTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetsofort', 'tl_iso_payment');
 
// giropay
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetgiropayTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetgiropay', 'tl_iso_payment');
     
// Barzahlen
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetbarzahlenTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetbarzahlenSlipExpiryDate', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetbarzahlenCallbackOrderStatus', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetbarzahlen', 'tl_iso_payment');
 
// Przelewy24
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetprzelewy24TestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetprzelewy24', 'tl_iso_payment');
  
// eps
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetepsTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalneteps', 'tl_iso_payment');
     
// Instalment by invoice
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetinstalmentinvoiceTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentinvoicePaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentinvoiceOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentinvoiceAllowB2B', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentinvoiceMinimumOrderAmount', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetinstalmentinvoice', 'tl_iso_payment');
    
// Instalment by SEPA
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetinstalmentsepaTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)    
    ->addField('novalnetinstalmentsepaOneClickShopping', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentsepaPaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentsepaOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentsepaAllowB2B', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetinstalmentsepaMinimumOrderAmount', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetinstalmentsepa', 'tl_iso_payment');

// PayPal
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetpaypalTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetpaypalOneClickShopping', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetpaypalPaymentAction', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetpaypalOnHoldLimit', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetpaypal', 'tl_iso_payment');
    
// Postfinance card
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetpostfinancecardTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetpostfinancecard', 'tl_iso_payment');
    
// Postfinance
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetpostfinanceTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetpostfinance', 'tl_iso_payment');
    
// Bancontact
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetbancontactTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetbancontact', 'tl_iso_payment');
        
// Multibanco
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('gateway_legend', 'price_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField('novalnetmultibancoTestMode', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('novalnetmultibancoCallbackOrderStatus', 'gateway_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('novalnetmultibanco', 'tl_iso_payment');
