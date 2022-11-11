{*
* 2007-2022 Carmine Di Gruttola
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
*  @author    cdigruttola <c.digruttola@hotmail.it>
*  @copyright 2007-2022 Carmine Di Gruttola
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="panel">
    <h3><i class="icon icon-truck"></i>{l s='SendCloud API' d='Modules.Sendcloudapi.Configure'}</h3>
    <img src="{$module_dir|escape:'html':'UTF-8'}/logo.png" id="payment-logo" class="pull-right"/>
    <p>
        <strong>{l s='Expose SendCloud API' d='Modules.Sendcloudapi.Configure'}</strong><br/>
    </p>
    <br/>
    <p>
        {l s='This module exposes SendCloud API to call' d='Modules.Sendcloudapi.Configure'}<br/>
        {l s='For tracking a page is available to insert tracking code and view tracking status' d='Modules.Sendcloudapi.Configure'}
    </p>
</div>

<div class="panel">
    <h3><i class="icon icon-tags"></i> {l s='Documentation' d='Modules.Sendcloudapi.Configure'}</h3>
    <p>
        &raquo; {l s='You can get a PDF documentation to configure this module' d='Modules.Sendcloudapi.Configure'}
        :
    <ul>
        <li><a href="#" target="_blank">{l s='English' d='Modules.Sendcloudapi.Configure'}</a></li>
        <li><a href="#" target="_blank">{l s='Italian' d='Modules.Sendcloudapi.Configure'}</a></li>
    </ul>
    </p>
</div>

<div class="panel">
    <h3><i class="icon icon-tags"></i> {l s='Information' d='Modules.Sendcloudapi.Configure'}</h3>
    <p>{l s='Base Tracking URL is' d='Modules.Sendcloudapi.Configure'} <a href="{$url_tracking}">{$url_tracking}?tracking_code=@</a></p>
    <p>{l s='Copy and paste in your carrier configuration' d='Modules.Sendcloudapi.Configure'}</p>
</div>
