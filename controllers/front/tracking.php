<?php

use cdigruttola\Module\Sendcloudapi\Translations\TrackingTranslations;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Copyright since 2007 Carmine Di Gruttola
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    cdigruttola <c.digruttola@hotmail.it>
 * @copyright Copyright since 2007 Carmine Di Gruttola
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class SendcloudapiTrackingModuleFrontController extends ModuleFrontController
{
    /**
     * @var
     */
    private $trackingTranslations;

    public function init()
    {
        parent::init();
        $trackingTranslations = new TrackingTranslations();
        $this->trackingTranslations = $trackingTranslations->getTranslations($this->context->language->iso_code);
    }

    public function getCanonicalURL()
    {
        return $this->context->link->getModuleLink($this->module->name, 'tracking');
    }

    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign(['trackingTranslations' => $this->trackingTranslations]);
        $this->setTemplate('module:sendcloudapi/views/templates/front/tracking.tpl');
    }

    public function process()
    {
        if ($tracking_code = Tools::getValue('tracking_code')) {
            $id_shop = $this->context->shop->id;
            try {
                $client = new Client();
                $response = $client->get('https://panel.sendcloud.sc/api/v2/tracking/' . $tracking_code, [
                    'auth' => [
                        Configuration::get(Sendcloudapi::SENDCLOUD_API_PUBLIC_KEY, null, null, $id_shop),
                        Configuration::get(Sendcloudapi::SENDCLOUD_API_SECRET_KEY, null, null, $id_shop),
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                usort($data['statuses'], fn ($a, $b) => strtotime($b['carrier_update_timestamp']) - strtotime($a['carrier_update_timestamp']));
                $this->context->smarty->assign([
                    'tracking' => $data,
                ]);
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $this->context->smarty->assign([
                    'status' => $response->getStatusCode(),
                    'reason' => $this->trackingTranslations[TrackingTranslations::TRACKING_COMMON_KEY . str_replace(' ', '_', strtoupper($response->getReasonPhrase()))] ?? $this->trackingTranslations[TrackingTranslations::TRACKING_COMMON_KEY . 'GENERIC_ERROR'],
                ]);
            }
        }
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = [
            'title' => $this->getTranslator()->trans('Tracking', [], 'Modules.Sendcloudapi.Tracking'),
            'url' => $this->context->link->getModuleLink($this->module->name, 'tracking'),
        ];

        if (Tools::getValue('tracking_code')) {
            $breadcrumb['links'][] = [
                'title' => $this->getTranslator()->trans('Result', [], 'Modules.Sendcloudapi.Tracking'),
                'url' => '',
            ];
        }

        return $breadcrumb;
    }
}
