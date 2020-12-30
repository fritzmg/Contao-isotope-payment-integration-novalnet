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
 */

namespace NovalnetGateway\IsotopeNovalnetBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use NovalnetGateway\IsotopeNovalnetBundle\IsotopeNovalnetBundle;

/**
 * Plugin for the Contao Manager.
 */
class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(IsotopeNovalnetBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, 'isotope']),
        ];
    }
}
