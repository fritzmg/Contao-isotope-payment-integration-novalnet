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
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetglobalconfig'] = ['Novalnet Haupteinstellungen'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetsepa'] = ['Novalnet SEPA-Lastschrift'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetcc'] = ['Novalnet Kredit- / Debitkarte'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetinvoice'] = ['Novalnet Rechnung'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetprepayment'] = ['Novalnet Vorkasse'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetguaranteedinvoice'] = ['Novalnet Rechnung mit Zahlungsgarantie'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetguaranteedsepa'] = ['Novalnet SEPA-Lastschrift mit Zahlungsgarantie'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetideal'] = ['Novalnet iDEAL'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetsofort'] = ['Novalnet Sofortüberweisung'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetgiropay'] = ['Novalnet giropay'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetbarzahlen'] = ['Novalnet Barzahlen/viacash'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetprzelewy24'] = ['Novalnet Przelewy24'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalneteps'] = ['Novalnet eps'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetinstalmentinvoice'] = ['Novalnet Ratenzahlung per Rechnung'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetinstalmentsepa'] = ['Novalnet Ratenzahlung per SEPA-Lastschrift'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetpaypal'] = ['Novalnet PayPal'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetpostfinancecard'] = ['Novalnet PostFinance Card'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetpostfinance'] = ['Novalnet PostFinance E-Finance'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetbancontact'] = ['Novalnet Bancontact'];
$GLOBALS['TL_LANG']['MODEL']['tl_iso_payment']['novalnetmultibanco'] = ['Novalnet Multibanco'];

$GLOBALS['TL_LANG']['MSC']['nn_transaction_id'] = 'Novalnet-Transaktions-ID: ';
$GLOBALS['TL_LANG']['MSC']['nn_test_mode'] = 'Testbestellung';

$GLOBALS['TL_LANG']['MSC']['nn_guarantee_payment'] = 'Diese Transaktion wird mit Zahlungsgarantie verarbeitet ';
$GLOBALS['TL_LANG']['MSC']['nn_invoice_guarantee_comment'] = 'Ihre Bestellung wird überprüft. Nach der Bestätigung senden wir Ihnen unsere Bankverbindung, an die Sie bitte den Gesamtbetrag der Bestellung überweisen. Bitte beachten Sie, dass dies bis zu 24 Stunden dauern kann';
$GLOBALS['TL_LANG']['MSC']['nn_sepa_guarantee_comment'] = ' Ihre Bestellung wird derzeit überprüft. Wir werden Sie in Kürze über den Bestellstatus informieren. Bitte beachten Sie, dass dies bis zu 24 Stunden dauern kann';

$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg'] = 'Die Zahlung kann nicht ausgeführt werden, weil die Voraussetzungen für die Zahlungsgarantie nicht erfüllt sind ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_error_msg'] = 'Die Zahlung kann nicht ausgeführt werden, weil die Voraussetzungen für die Ratenzahlung nicht erfüllt sind ';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_amount'] = '(Mindestbestellwert %s EUR)';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_currency'] = '(Nur EUR als Währung erlaubt)';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_address'] = '(Die Lieferadresse muss mit der Rechnungsadresse identisch sein)';
$GLOBALS['TL_LANG']['MSC']['nn_guarantee_error_msg_country'] = '(nur Deutschland, Österreich oder die Schweiz sind zulässig)';

$GLOBALS['TL_LANG']['MSC']['nn_checkhash_failed'] = 'Während der Umleitung wurden einige Daten geändert. Die Überprüfung des Hashes schlug fehl';

// Invoice Prepayment comments
$GLOBALS['TL_LANG']['MSC']['nn_order_note_due_date'] = 'Bitte überweisen Sie den Betrag von %s spätestens bis zum %s auf das folgende Konto';
$GLOBALS['TL_LANG']['MSC']['nn_order_note'] = 'Bitte überweisen Sie den Betrag %s auf das unten stehende Konto';
$GLOBALS['TL_LANG']['MSC']['nn_due_date'] = 'Fälligkeitsdatum:';
$GLOBALS['TL_LANG']['MSC']['nn_account_holder'] = 'Kontoinhaber: ';
$GLOBALS['TL_LANG']['MSC']['nn_amount'] = 'Betrag: ';
$GLOBALS['TL_LANG']['MSC']['nn_bank_place'] = 'Ort: ';
$GLOBALS['TL_LANG']['MSC']['nn_reference_note'] = 'Bitte verwenden Sie einen der unten angegebenen Verwendungszwecke für die Überweisung. Nur so kann Ihr Geldeingang Ihrer Bestellung zugeordnet werden';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_reference_note'] = 'Bitte verwenden der unten angegebenen Zahlungsreferenz für die Überweisung. Nur so kann Ihr Geldeingang Ihrer Bestellung zugeordnet werden';
$GLOBALS['TL_LANG']['MSC']['nn_payment_reference'] = 'Verwendungszweck : ';
$GLOBALS['TL_LANG']['MSC']['nn_payment_reference_1'] = 'Verwendungszweck 1: ';
$GLOBALS['TL_LANG']['MSC']['nn_payment_reference_2'] = 'Verwendungszweck 2: ';

// Cashpayment comments
$GLOBALS['TL_LANG']['MSC']['nn_slip_exipry_date'] = 'Verfallsdatum des Zahlscheins %s:';
$GLOBALS['TL_LANG']['MSC']['nn_cashpayment_store'] = 'Barzahlen-Partnerfiliale in Ihrer Nähe';

$GLOBALS['TL_LANG']['MSC']['nn_instalment_info'] = 'Information zu den Raten:';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_processed'] = 'Bezahlte Raten: ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_due'] = 'Offene Raten: ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_cycle_amount'] = 'Betrag jeder Rate: ';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_debit_text'] = 'Die nächste Rate in Höhe von %s wird in ein bis drei Werktagen von Ihrem Konto abgebucht.';
$GLOBALS['TL_LANG']['MSC']['nn_instalment_received'] = 'Für die Transaktions-ID ist eine neue Rate eingegangen:%s mit Betrag %s am %s. Die Transaktions-ID der neuen Rate lautet: %s';

// Multibanco comments
$GLOBALS['TL_LANG']['MSC']['nn_multibanco_comment'] = 'Bitte verwenden Sie die folgende Zahlungsreferenz, um den Betrag von %s %s an einem Multibanco-Geldautomaten oder über Ihr Onlinebanking zu bezahlen';
$GLOBALS['TL_LANG']['MSC']['nn_multibanco_reference'] = 'Partner-Zahlungsreferenz: %s';
$GLOBALS['TL_LANG']['MSC']['nn_multibanco_reference_entity'] = 'Entität (Nummer der Bank / des Unternehmens, welches die Zahlung durchführt): %s';

// Webhook
$GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_confirm'] = 'Novalnet-Rückruf erhalten. Die Transaktion wurde bestätigt am %s';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_cancel'] = 'Novalnet-Rückruf erhalten. Die Transaktion wurde am %s abgebrochen';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_transaction_pending_to_onhold'] = 'Novalnet-Rückruf erhalten. Der Transaktionsstatus wurde für die TID von "ausstehend" in "gehalten" geändert: %s am %s';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_parent_tid'] = 'Die Rückerstattung für die TID: %s mit dem Betrag %s %s wurde veranlasst ';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_refund_child_tid'] = 'Die Rückerstattung für die TID: %s mit dem Betrag %s %s wurde veranlasst. Die neue TID für den erstatteten Betrag %s %s lautet: %s';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_transfer_amount'] = 'Bitte überweisen Sie den Betrag in Höhe von %s %s is spätestens %s';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_cashpayment_transfer_update'] = 'Die Transaktion wurde mit dem Betrag: %s neues Fälligkeitsdatum des Zahlscheins: %s. ';
$GLOBALS['TL_LANG']['MSC']['nn_webhook_transfer_update'] = 'Die Transaktion wurde mit dem Betrag %s %s und dem Fälligkeitsdatum aktualisiert %s. ';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_chargeback'] = 'Chargeback erfolgreich importiert für die TID: %s Betrag: %s am %s um %s Uhr. TID der Folgebuchung: %s.';
$GLOBALS['TL_LANG']['MSC']['nn_online_transfer_credit'] = 'Die Gutschrift für die TID ist erfolgreich eingegangen: %s mit Betrag %s  am %s. Bitte entnehmen Sie die TID den Einzelheiten der Bestellung bei BEZAHLT in unserem Novalnet Adminportal: %s';

$GLOBALS['TL_LANG']['MSC']['nn_webhook_credit'] = 'Die Gutschrift für die TID ist erfolgreich eingegangen: %s mit Betrag %s am %s. Bitte entnehmen Sie die TID den Einzelheiten der Bestellung bei BEZAHLT in unserem Novalnet Adminportal: %s';
