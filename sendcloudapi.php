<?php
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

use cdigruttola\Sendcloudapi\Form\DataConfiguration\SendCloudApiDataConfiguration;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

class Sendcloudapi extends Module
{
    public function __construct()
    {
        $this->name = 'sendcloudapi';
        $this->tab = 'shipping_logistics';
        $this->version = '1.1.0';
        $this->author = 'cdigruttola';
        $this->need_instance = 0;
        $this->controllers = ['tracking'];

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('SendCloud API', [], 'Modules.Sendcloudapi.Main');
        $this->description = $this->trans('Expose SendCloud API', [], 'Modules.Sendcloudapi.Main');

        $this->ps_versions_compliancy = ['min' => '1.7.8', 'max' => _PS_VERSION_];
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    public function install()
    {
        if (!extension_loaded('curl')) {
            $this->_errors[] = $this->trans('You have to enable the cURL extension on your server to install this module', [], 'Modules.Sendcloudapi.Main');

            return false;
        }

        return parent::install()
            && $this->registerHook('displayHeader');
    }

    public function uninstall($reset = false)
    {
        if (!$reset) {
            Configuration::deleteByName(SendCloudApiDataConfiguration::SENDCLOUD_API_PUBLIC_KEY);
            Configuration::deleteByName(SendCloudApiDataConfiguration::SENDCLOUD_API_SECRET_KEY);

            return parent::uninstall();
        }

        return true;
    }

    public function onclickOption($opt, $href)
    {
        if ($opt === 'reset') {
            return $this->uninstall(true) && $this->install();
        }

        return true;
    }

    public function getContent()
    {
        Tools::redirectAdmin(SymfonyContainer::getInstance()->get('router')->generate('sendcloudapi_controller'));
    }

    /**
     * Add the CSS file you want to be added on the FO.
     */
    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/front.css');
    }
}
