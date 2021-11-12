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
$GLOBALS['TL_LANG']['tl_iso_payment'] = array_merge($GLOBALS['TL_LANG']['tl_iso_payment'], [
    'novalnetglobalconfigActivationKey' => ['Product activation key', 'Get your Product activation key from the Novalnet Admin Portal: PROJECT > Choose your project > Shop Parameters > API Signature (Product activation key)'],
    'novalnetglobalconfigTariffId' => ['Tariff ID', 'Enter a Tariff ID to match the preferred tariff plan you created at the Novalnet Admin Portal for this project'],
    'novalnetglobalconfigAccessKey' => ['Payment access key ', 'Get your Payment access key from the Novalnet Admin Portal PROJECT > Choose your project > Shop Parameters > Payment access key'],
    'novalnetglobalconfigWebhookTestMode' => ['Allow manual testing of the Notification / Webhook URL', 'Enable this to test the Novalnet Notification / Webhook URL manually. Disable this before setting your shop live to block unauthorized calls from external parties'],
    'novalnetglobalconfigEnableSendMail' => ['Notification / Webhook URL execution messages will be sent to this e-mail', '
Additional e-mails to which Webhook execution messages will be sent'],
    'novalnetglobalconfigWebHookSendMail' => ['Send e-mail to', 'Notification / Webhook URL execution messages will be sent to this e-mail'],
         
    'novalnetinvoiceTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetinvoiceDueDate' => ['Payment due date (in days)', 'Number of days given to the buyer to transfer the amount to Novalnet (must be greater than 7 days). If this field is left blank, 14 days will be set as due date by default'],
    'novalnetinvoicePaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetinvoiceOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
    'novalnetinvoiceCallbackOrderStatus' => ['Callback / webhook order status', 'Status to be used when callback script is executed for payment received by Novalnet'],

    'novalnetccTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetccOneClickShopping' => ['One-click shopping', 'Payment details stored during the checkout process can be used for future payments'],
    'novalnetccPaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetccOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
     
    'novalnetsepaTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetsepaDueDate' => ['Payment due date (in days)', 'Number of days after which the payment is debited (must be between 2 and 14 days)'],
    'novalnetsepaOneClickShopping' => ['One-click shopping', 'Payment details stored during the checkout process can be used for future payments'],
    'novalnetsepaPaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetsepaOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
      
    'novalnetprepaymentTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],    
    'novalnetprepaymentCallbackOrderStatus' => ['Callback / webhook order status', 'Status to be used when callback script is executed for payment received by Novalnet'],
    
    'novalnetguaranteedinvoiceTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetguaranteedinvoicePaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetguaranteedinvoiceOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
    'novalnetguaranteedinvoiceForceNonGuarantee' => ['Force non-guarantee payment', 'Even if payment guarantee is enabled, payments will still be processed as non-guarantee payments if the payment guarantee requirements are not met. Review the requirements under "Enable Payment Guarantee" in the Installation Guide'],
    'novalnetguaranteedinvoiceAllowB2B' => ['Allow B2B Customers', 'Allow B2B customers to place order'],
    'novalnetguaranteedinvoiceMinimumOrderamount' => ['Minimum order amount for payment guarantee ', 'Enter the minimum amount (in cents) for the transaction to be processed with payment guarantee. For example, enter 100 which is equal to 1,00. By default, the amount will be 9,99 EUR'],
    
    'novalnetguaranteedsepaTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],    
    'novalnetguaranteedsepaOneClickShopping' => ['One-click shopping', 'Payment details stored during the checkout process can be used for future payments'],
    'novalnetguaranteedsepaPaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetguaranteedsepaOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
    'novalnetguaranteedsepaForceNonGuarantee' => ['Force non-guarantee payment', 'Even if payment guarantee is enabled, payments will still be processed as non-guarantee payments if the payment guarantee requirements are not met. Review the requirements under "Enable Payment Guarantee" in the Installation Guide'],
    'novalnetguaranteedsepaAllowB2B' => ['Allow B2B Customers', 'Allow B2B customers to place order'],
    'novalnetguaranteedsepaMinimumOrderamount' => ['Minimum order amount for payment guarantee ', 'Enter the minimum amount (in cents) for the transaction to be processed with payment guarantee. For example, enter 100 which is equal to 1,00. By default, the amount will be 9,99 EUR'],
    
    'novalnetidealTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetsofortTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetgiropayTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetbarzahlenTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetbarzahlenSlipExpiryDate' => ['Slip expiry date (in days)', 'Number of days given to the buyer to pay at a store. If this field is left blank, 14 days will be set as slip expiry date by default'],
    'novalnetbarzahlenCallbackOrderStatus' => ['Callback / webhook order status', 'Status to be used when callback script is executed for payment received by Novalnet'],
    
    'novalnetprzelewy24TestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetepsTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetinstalmentinvoiceTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetinstalmentinvoicePaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetinstalmentinvoiceOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
    'novalnetinstalmentinvoiceAllowB2B' => ['Allow B2B Customers', 'Allow B2B customers to place order'],
    'novalnetinstalmentinvoiceMinimumOrderAmount' => ['Minimum order amount', 'Enter the minimum amount (in cents) for the transaction to be processed with payment guarantee. For example, enter 100 which is equal to 1,00. By default, the amount will be 300 EUR'],
    
    'novalnetinstalmentsepaTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],    
    'novalnetinstalmentsepaOneClickShopping' => ['One-click shopping', 'Payment details stored during the checkout process can be used for future payments'],
    'novalnetinstalmentsepaPaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetinstalmentsepaOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
    'novalnetinstalmentsepaAllowB2B' => ['Allow B2B Customers', 'Allow B2B customers to place order'],
    'novalnetinstalmentsepaMinimumOrderAmount' => ['Minimum order amount', 'Enter the minimum amount (in cents) for the transaction to be processed with payment guarantee. For example, enter 100 which is equal to 1,00. By default, the amount will be 300 EUR'],
        
    'novalnetpaypalTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetpaypalOneClickShopping' => ['One-click shopping', 'Payment details stored during the checkout process can be used for future payments'],
    'novalnetpaypalPaymentAction' => ['Payment Action', 'Choose whether or not the payment should be charged immediately. Capture completes the transaction by transferring the funds from buyer account to merchant account. Authorize verifies payment details and reserves funds to capture it later, giving time for the merchant to decide on the order'],
    'novalnetpaypalOnHoldLimit' => ['Minimum transaction amount for authorization', 'Transactions above this amount will be "authorized only" until you capture. Leave the field blank to authorize all transactions'],
    
    'novalnetpostfinancecardTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetpostfinanceTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetbancontactTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    
    'novalnetmultibancoTestMode' => ['Enable test mode', 'Enable this option to test payments at your checkout page. In the test mode the amount will not actually be charged by Novalnet. Remember to disable the test mode again after testing to ensure that actual purchased are properly charged'],
    'novalnetmultibancoCallbackOrderStatus' => ['Callback / webhook order status', 'Status to be used when callback script is executed for payment received by Novalnet'],
]);
