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
\Isotope\Model\Payment::registerModelType('novalnetglobalconfig', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetGlobalConfiguration::class);
\Isotope\Model\Payment::registerModelType('novalnetsepa', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetSepa::class);
\Isotope\Model\Payment::registerModelType('novalnetcc', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetCreditcard::class);
\Isotope\Model\Payment::registerModelType('novalnetinvoice', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetInvoice::class);
\Isotope\Model\Payment::registerModelType('novalnetprepayment', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetPrepayment::class);
\Isotope\Model\Payment::registerModelType('novalnetguaranteedinvoice', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetGuaranteedInvoice::class);
\Isotope\Model\Payment::registerModelType('novalnetguaranteedsepa', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetGuaranteedSepa::class);
\Isotope\Model\Payment::registerModelType('novalnetideal', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetIdeal::class);
\Isotope\Model\Payment::registerModelType('novalnetsofort', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetSofort::class);
\Isotope\Model\Payment::registerModelType('novalnetgiropay', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetGiropay::class);
\Isotope\Model\Payment::registerModelType('novalnetbarzahlen', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetBarzahlen::class);
\Isotope\Model\Payment::registerModelType('novalnetprzelewy24', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetPrzelewy24::class);
\Isotope\Model\Payment::registerModelType('novalneteps', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetEps::class);
\Isotope\Model\Payment::registerModelType('novalnetinstalmentinvoice', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetInstalmentInvoice::class);
\Isotope\Model\Payment::registerModelType('novalnetinstalmentsepa', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetInstalmentSepa::class);
\Isotope\Model\Payment::registerModelType('novalnetpaypal', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetPaypal::class);
\Isotope\Model\Payment::registerModelType('novalnetpostfinancecard', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetPostfinancecard::class);
\Isotope\Model\Payment::registerModelType('novalnetpostfinance', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetPostfinance::class);
\Isotope\Model\Payment::registerModelType('novalnetbancontact', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetBancontact::class);
\Isotope\Model\Payment::registerModelType('novalnetmultibanco', \NovalnetGateway\IsotopeNovalnetBundle\Isotope\Model\Payment\NovalnetMultibanco::class);
