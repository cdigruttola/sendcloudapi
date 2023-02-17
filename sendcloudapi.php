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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Sendcloudapi extends Module
{
    public const SENDCLOUD_API_PUBLIC_KEY = 'SENDCLOUD_API_PUBLIC_KEY';
    public const SENDCLOUD_API_SECRET_KEY = 'SENDCLOUD_API_SECRET_KEY';
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'sendcloudapi';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'cdigruttola';
        $this->need_instance = 0;
        $this->controllers = ['tracking'];

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('SendCloud API', [], 'Modules.Sendcloudapi.Main');
        $this->description = $this->trans('Expose SendCloud API', [], 'Modules.Sendcloudapi.Main');

        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }


    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        if (!extension_loaded('curl')) {
            $this->_errors[] = $this->trans('You have to enable the cURL extension on your server to install this module', [], 'Modules.Sendcloudapi.Main');
            return false;
        }

        return parent::install() &&
            $this->registerHook('displayHeader');
    }

    public function uninstall($reset = false)
    {
        if (!$reset) {
            Configuration::deleteByName(self::SENDCLOUD_API_PUBLIC_KEY);
            Configuration::deleteByName(self::SENDCLOUD_API_SECRET_KEY);
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

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        $output = '';
        if ((Tools::isSubmit('submitSendcloudapiModule'))) {
            if ($this->postProcess()) {
                $output .= $this->displayConfirmation($this->trans('Settings updated succesfully', [], 'Modules.Sendcloudapi.Main'));
            } else {
                $output .= $this->displayError($this->trans('Error occurred during settings update', [], 'Modules.Sendcloudapi.Main'));
            }

        }

        $this->context->smarty->assign('module_dir', $this->_path);
        $this->context->smarty->assign('url_tracking', $this->context->link->getModuleLink($this->name, 'tracking'));

        $output .= $this->context->smarty->fetch($this->local_path . 'views/templates/admin/configure.tpl');

        return $output . $this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitSendcloudapiModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                    'title' => $this->trans('Settings', [], 'Modules.Sendcloudapi.Main'),
                    'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'col' => 3,
                        'type' => 'text',
                        'desc' => $this->trans('Enter SendCloud API Public KEY', [], 'Modules.Sendcloudapi.Main'),
                        'name' => self::SENDCLOUD_API_PUBLIC_KEY,
                        'label' => $this->trans('SendCloud API Public KEY', [], 'Modules.Sendcloudapi.Main'),
                    ],
                    [
                        'type' => 'password',
                        'desc' => $this->trans('Enter SendCloud API Secret KEY', [], 'Modules.Sendcloudapi.Main'),
                        'name' => self::SENDCLOUD_API_SECRET_KEY,
                        'label' => $this->trans('SendCloud API Secret KEY', [], 'Modules.Sendcloudapi.Main'),
                    ],
                ],
                'submit' => [
                    'title' => $this->trans('Save', [], 'Modules.Sendcloudapi.Main'),
                ],
            ],
        ];
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $id_shop = $this->context->shop->id;
        return [
            self::SENDCLOUD_API_PUBLIC_KEY => Configuration::get(self::SENDCLOUD_API_PUBLIC_KEY, null, null, $id_shop),
            self::SENDCLOUD_API_SECRET_KEY => Configuration::get(self::SENDCLOUD_API_SECRET_KEY, null, null, $id_shop),
        ];
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();
        $res = true;

        foreach (array_keys($form_values) as $key) {
            $res &= Configuration::updateValue($key, Tools::getValue($key));
        }
        return $res;
    }

    /**
     * Add the CSS file you want to be added on the FO.
     */
    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
    }

}
