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
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetglobalconfig'] = ['Novalnet Global Configuration'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetsepa'] = ['Novalnet Direct Debit SEPA'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetcc'] = ['Novalnet Credit/Debit Cards'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetinvoice'] = ['Novalnet Invoice'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetprepayment'] = ['Novalnet Prepayment'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetguaranteedinvoice'] = ['Novalnet Invoice with payment guarantee'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetguaranteedsepa'] = ['Novalnet Direct Debit SEPA with payment guarantee'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetideal'] = ['Novalnet iDEAL'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetsofort'] = ['Novalnet Sofort'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetgiropay'] = ['Novalnet giropay'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetbarzahlen'] = ['Novalnet Barzahlen/viacash'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetprzelewy24'] = ['Novalnet Przelewy24'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalneteps'] = ['Novalnet eps'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetinstalmentinvoice'] = ['Novalnet Instalment by Invoice'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetinstalmentsepa'] = ['Novalnet Instalment by Direct Debit SEPA'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetpaypal'] = ['Novalnet PayPal'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetpostfinancecard'] = ['Novalnet PostFinance Card'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetpostfinance'] = ['Novalnet PostFinance E-Finance'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetbancontact'] = ['Novalnet Bancontact'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetmultibanco'] = ['Novalnet Multibanco'];

$GLOBALS['TL_LANG']['MSC']['nn_transaction_id'] = 'Novalnet transaction ID: ';
$GLOBALS['TL_LANG']['MSC']['nn_test_mode'] = 'Test order';

$GLOBALS['TL_LANG']['MSC']['nn_guarantee_payment'] = 'This is processed as a guarantee payment';
$GLOBALS['TL_LANG']['MSC']['nn_invoice_guarantee_comment'] = 'Your order is being verified. Once confirmed, we will send you our bank details to which the order amount should be transferred. Please note that this may take up to 24 hours';
$GLOBALS['TL_LANG']['MSC']['nn_sepa_guarantee_comment'] = 'Your order is under verification and we will soon update you with the order status. Please note that this may take upto 24 hours';

$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg'] = 'The payment cannot be processed, because the basic requirements for the payment guarantee are not met ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_error_msg'] = 'The payment cannot be processed, because the basic requirements for the payment Instalment are not met ';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_amount'] = '(Minimum order amount must be %s EUR)';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_currency'] = '(Only EUR currency allowed)';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_address'] = '(The shipping address must be the same as the billing address)';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_country'] = '(Only Germany, Austria or Switzerland are allowed)';

$GLOBALS['TL_LANG']['MSC']['nn_checkhash_failed'] = 'While redirecting some data has been changed. The hash check failed';

// Invoice Prepayment comments
$GLOBALS['TL_LANG']['MSC']['nn_order_note_due_date'] = 'Please transfer the amount of %s to the following account on or before %s';
$GLOBALS['TL_LANG']['MSC']['nn_order_note'] = 'Please transfer the amount of %s to the following account.';
$GLOBALS['TL_LANG']['MSC']['nn_due_date'] = 'Due date:';
$GLOBALS['TL_LANG']['MSC']['nn_account_holder'] = 'Account holder: ';
$GLOBALS['TL_LANG']['MSC']['nn_amount'] = 'Amount: ';
$GLOBALS['TL_LANG']['MSC']['nn_bank_place'] = 'Place: ';
$GLOBALS['TL_LANG']['MSC']['nn_reference_note'] = 'Please use any of the following payment references when transferring the amount. This is necessary to match it with your corresponding order';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_reference_note'] = 'Please use the following payment reference when transferring the amount. This is necessary to match it with your corresponding order';
$GLOBALS['TL_LANG']['MSC']['nn_payment_reference'] = 'Payment Reference : ';
$GLOBALS['TL_LANG']['MSC']['nn_payment_reference_1'] = 'Payment Reference 1: ';
$GLOBALS['TL_LANG']['MSC']['nn_payment_reference_2'] = 'Payment Reference 2: ';

// Cashpayment comments
$GLOBALS['TL_LANG']['MSC']['nn_slip_exipry_date'] = 'Slip expiry date %s:';
$GLOBALS['TL_LANG']['MSC']['nn_cashpayment_store'] = 'Store(s) near you';


$GLOBALS['TL_LANG']['MSC']['nn_instalment_info'] = 'Instalment Information:';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_processed'] = 'Processed Instalments: ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_due'] = 'Due Instalments: ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_cycle_amount'] = 'Instalment Cycle Amount: ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_debit_text'] = 'The instalment amount for this cycle %s will be debited from your account in one - three business days.';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_received'] = 'A new instalment has been received for the Transaction ID:%s  with amount %s on %s. The new instalment transaction ID is: %s';

// Multibanco comments
$GLOBALS['TL_LANG']['MSC']['nn_multibanco_comment'] = 'Please use the following payment reference details to pay the amount of %s %s at a Multibanco ATM or through your internet banking';
$GLOBALS['TL_LANG']['MSC']['nn_multibanco_reference'] = 'Partner Payment Reference: %s';
$GLOBALS['TL_LANG']['MSC']['nn_multibanco_reference_entity'] = 'Entity: %s';

// Webhook
$GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_confirm'] = 'Novalnet callback received. The transaction has been confirmed on %s.';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_cancel'] = 'Novalnet callback received. The transaction has been canceled on %s.';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_pending_to_onhold'] = 'Novalnet callback received. The transaction status has been changed from pending to on-hold for the TID: %s on %s & time';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_parent_tid'] = 'Refund has been initiated for the TID: %s with the amount %s %s';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_child_tid'] = 'Refund has been initiated for the TID: %s with the amount %s %s. New TID:%s for the refunded amount %s %s';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_transfer_amount'] = 'Please transfer the amount of %s %s on or before %s ';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_transfer_update'] = 'The transaction has been updated with amount %s %s and due date %s';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_cashpayment_transfer_update'] = 'The transaction has been updated with amount %s and slip expiry date %s';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_chargeback'] = 'Chargeback executed successfully for the TID: %s amount: %s on %s %s. The subsequent TID: %s.';
$GLOBALS['TL_LANG']['MSC']['nn_online_transfer_credit'] = 'Credit has been successfully received for the TID: %s with amount %s on %s. Please refer PAID order details in our Novalnet Admin Portal for the TID: %s';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_credit'] = 'Credit executed successfully for the TID: %s with amount %s on %s. Please refer PAID transaction in our Novalnet Merchant Administration with the TID: %s';
