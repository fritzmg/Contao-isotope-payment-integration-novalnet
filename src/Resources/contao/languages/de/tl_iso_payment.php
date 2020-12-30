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
    'novalnetglobalconfigActivationKey' => [' Produktaktivierungsschlüssel', 'Ihren Produktaktivierungsschlüssel finden Sie im Novalnet Admin-Portal: PROJEKT > Wählen Sie Ihr Projekt > Shop-Parameter > API-Signatur (Produktaktivierungsschlüssel)'],
    'novalnetglobalconfigTariffId' => ['Tarif-ID', ''],
    'novalnetglobalconfigAccessKey' => ['Zahlungs-Zugriffsschlüssel', 'Ihren Paymentzugriffsschlüssel finden Sie im Novalnet Admin-Portal: PROJEKT > Wählen Sie Ihr Projekt > Shop-Parameter > Paymentzugriffsschlüssel'],
    'novalnetglobalconfigWebhookTestMode' => ['Manuelles Testen der Benachrichtigungs- / Webhook-URL erlauben', 'Aktivieren Sie diese Option, um die Novalnet-Benachrichtigungs-/Webhook-URL manuell zu testen. Deaktivieren Sie die Option, bevor Sie Ihren Shop liveschalten, um unautorisierte Zugriffe von Dritten zu blockieren '],
    'novalnetglobalconfigEnableSendMail' => ['E-Mail-Benachrichtigungen werden an diese E-Mail-Adresse gesendet', 'Zusätzliche E-Mail-Adresse für E-Mail-Benachrichtigungen'],
    'novalnetglobalconfigWebHookSendMail' => ['E-Mails senden an', ''],
        
    'novalnetinvoiceTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetinvoiceDueDate' => ['Fälligkeitsdatum (in Tagen)', 'Anzahl der Tage, die der Käufer Zeit hat, um den Betrag an Novalnet zu überweisen (muss mehr als 7 Tage betragen). Wenn Sie dieses Feld leer lassen, werden standardmäßig 14 Tage als Fälligkeitsdatum festgelegt'],
    'novalnetinvoicePaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetinvoiceOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', ' Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren'],
    'novalnetinvoiceCallbackOrderStatus' => ['Status bei ausgeführtem Callback-Skript', 'Status, der zu verwendet wird, wenn das Callback-Skript für eine bei Novalnet eingegangene Zahlung ausgeführt wird'],

    'novalnetccTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetccOneClickShopping' => ['Kauf mit einem Klick', ''],
    'novalnetccPaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetccOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
     
    'novalnetsepaTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetsepaDueDate' => ['Fälligkeitsdatum (in Tagen)', 'Geben Sie die Anzahl der Tage ein, nach denen der Zahlungsbetrag eingezogen werden soll (muss zwischen 2 und 14 Tagen liegen) '],
    'novalnetsepaOneClickShopping' => ['Kauf mit einem Klick', ''],
    'novalnetsepaPaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetsepaOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
      
    'novalnetprepaymentTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],    
    'novalnetprepaymentCallbackOrderStatus' => ['Status bei ausgeführtem Callback-Skript', 'Status, der zu verwendet wird, wenn das Callback-Skript für eine bei Novalnet eingegangene Zahlung ausgeführt wird'],
    
    'novalnetguaranteedinvoiceTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetguaranteedinvoicePaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetguaranteedinvoiceOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
    'novalnetguaranteedinvoiceForceNonGuarantee' => ['Zahlung ohne Zahlungsgarantie erzwingen', ''],
    'novalnetguaranteedinvoiceAllowB2B' => ['B2B-Kunden erlauben', 'B2B-Kunden erlauben, Bestellungen aufzugeben '],
    'novalnetguaranteedinvoiceMinimumOrderamount' => ['Mindestbestellbetrag für Zahlungsgarantie ', 'Geben Sie den Mindestbetrag (in Cent) für die zu bearbeitende Transaktion mit Zahlungsgarantie ein. Geben Sie z.B. 100 ein, was 1,00 entspricht. Der Standbetrag ist 9,99 EUR'],
    
    'novalnetguaranteedsepaTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],    
    'novalnetguaranteedsepaOneClickShopping' => ['Kauf mit einem Klick', ''],
    'novalnetguaranteedsepaPaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetguaranteedsepaOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
    'novalnetguaranteedsepaForceNonGuarantee' => ['Zahlung ohne Zahlungsgarantie erzwingen', ''],
    'novalnetguaranteedsepaAllowB2B' => ['B2B-Kunden erlauben', 'B2B-Kunden erlauben, Bestellungen aufzugeben '],
    'novalnetguaranteedsepaMinimumOrderamount' => ['Mindestbestellbetrag für Zahlungsgarantie ', 'Geben Sie den Mindestbetrag (in Cent) für die zu bearbeitende Transaktion mit Zahlungsgarantie ein. Geben Sie z.B. 100 ein, was 1,00 entspricht. Der Standbetrag ist 9,99 EUR'],
    
    'novalnetidealTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetsofortTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetgiropayTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetbarzahlenTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetbarzahlenSlipExpiryDate' => ['Verfallsdatum des Zahlscheins (in Tagen)', 'Anzahl der Tage, die der Käufer Zeit hat, um den Betrag in einer Filiale zu bezahlen. Wenn Sie dieses Feld leer lassen, ist der Zahlschein standardmäßig 14 Tage lang gültig'],
    'novalnetbarzahlenCallbackOrderStatus' => ['Status bei ausgeführtem Callback-Skript', 'Status, der zu verwendet wird, wenn das Callback-Skript für eine bei Novalnet eingegangene Zahlung ausgeführt wird'],
    
    'novalnetprzelewy24TestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetepsTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetinstalmentinvoiceTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetinstalmentinvoicePaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetinstalmentinvoiceOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
    'novalnetinstalmentinvoiceAllowB2B' => ['B2B-Kunden erlauben', 'B2B-Kunden erlauben, Bestellungen aufzugeben '],
    'novalnetinstalmentinvoiceMinimumOrderAmount' => ['Mindestbestellbetrag', 'Geben Sie den Mindestbetrag (in Cent) für die zu bearbeitende Transaktion mit Zahlungsgarantie ein. Geben Sie z.B. 100 ein, was 1,00 entspricht. Der Standbetrag ist 300 EUR'],
    
    'novalnetinstalmentsepaTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],    
    'novalnetinstalmentsepaOneClickShopping' => ['Kauf mit einem Klick', ''],
    'novalnetinstalmentsepaPaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetinstalmentsepaOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
    'novalnetinstalmentsepaAllowB2B' => ['B2B-Kunden erlauben', ' B2B-Kunden erlauben, Bestellungen aufzugeben '],
    'novalnetinstalmentsepaMinimumOrderAmount' => ['Mindestbestellbetrag', 'Geben Sie den Mindestbetrag (in Cent) für die zu bearbeitende Transaktion mit Zahlungsgarantie ein. Geben Sie z.B. 100 ein, was 1,00 entspricht. Der Standbetrag ist 300 EUR'],
        
    'novalnetpaypalTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetpaypalOneClickShopping' => ['Kauf mit einem Klick', ''],
    'novalnetpaypalPaymentAction' => ['Aktion für vom Besteller autorisierte Zahlungen', 'Wählen Sie, ob die Zahlung sofort belastet werden soll oder nicht. Zahlung einziehen: Betrag sofort belasten. Zahlung autorisieren: Die Zahlung wird überprüft und autorisiert, aber erst zu einem späteren Zeitpunkt belastet. So haben Sie Zeit, über die Bestellung zu entscheiden'],
    'novalnetpaypalOnHoldLimit' => ['Mindesttransaktionsbetrag für die Autorisierung', 'Transaktionen über diesem Betrag werden bis zum Capture als "nur autorisiert" gekennzeichnet. Lassen Sie das Feld leer, um alle Transaktionen zu autorisieren '],
    
    'novalnetpostfinancecardTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetpostfinanceTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetbancontactTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    
    'novalnetmultibancoTestMode' => ['Testmodus aktivieren', 'Aktivieren Sie diese Option, um das Bezahlen auf Ihrer Checkout-Seite zu testen. Im Testmodus werden Zahlungen nicht von Novalnet ausgeführt. Vergessen Sie nicht, den Testmodus nach dem Testen wieder zu deaktivieren, um sicherzustellen, dass die echten Bestellungen ordnungsgemäß abgerechnet werden'],
    'novalnetmultibancoCallbackOrderStatus' => ['Status bei ausgeführtem Callback-Skript', 'Status, der zu verwendet wird, wenn das Callback-Skript für eine bei Novalnet eingegangene Zahlung ausgeführt wird'],
]);
