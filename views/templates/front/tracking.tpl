{*
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
*  @author    cdigruttola <c.digruttola@hotmail.it>
*  @copyright Copyright since 2007 Carmine Di Gruttola
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{extends file='page.tpl'}

{$tracking_svgs = [
'SENDCLOUD_API_TRACKING_STATE_ANNOUNCING' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><path fill="#fff" d="M35.3.2L16 7.8v20.8l19.3 7.6c2.2.9 4.5-.7 4.5-3.1V3.3C39.9 1 37.5-.6 35.3.2zM42.1 11.7v13.1c3.3-.3 5.9-3.1 5.9-6.5s-2.6-6.3-5.9-6.6zM14.5 30.7h-4.1c-1.1 0-2.1-.1-3.1-.4l3.1 15c.3 1.6 1.7 2.7 3.4 2.7 2.2 0 3.8-2 3.4-4.2l-2.7-13.1zM8.2 25.6H3.1c1.9 1.9 4.5 3 7.3 3h3.4V7.8h-3.4c-2.9 0-5.4 1.2-7.3 3h5.1c.6 0 1 .5 1 1 0 .6-.5 1-1 1H1.5c-.4.7-.7 1.4-1 2.1h7.7c.6 0 1 .5 1 1 0 .6-.5 1-1 1H.1c-.1.6-.1 1-.1 1.3s0 .7.1 1.1h8.1c.6 0 1 .5 1 1 0 .6-.5 1-1 1H.5c.2.8.6 1.5 1 2.1h6.7c.6 0 1 .5 1 1 0 .7-.4 1.2-1 1.2z"></path></svg>',
'SENDCLOUD_API_TRACKING_STATE_TO_SORTING' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-10 0 125 125"><path fill="#fff" d="M98.9 66.22a5 5 0 0 1-3.9 5.87L37.38 83.43a10.08 10.08 0 1 1-10.86-5.17c.33-.06.65-.11 1-.14L16.71 23.25 2.64 10.46a5 5 0 0 1 6.73-7.4L24.66 17a5 5 0 0 1 1.54 2.7l10.56 53.66L93 62.28a5 5 0 0 1 5.9 3.94zm-62.58-19.3l3.78 19.22a1.79 1.79 0 0 0 2.1 1.41l19.22-3.78a1.79 1.79 0 0 0 1.41-2.1L59 42.44A1.79 1.79 0 0 0 56.95 41l-7.26 1.43L51 49.4l-4.5.89-1.37-6.94-7.46 1.47a1.79 1.79 0 0 0-1.35 2.1zm30.76 13.91a1.79 1.79 0 0 0 2.1 1.41l19.22-3.78a1.79 1.79 0 0 0 1.41-2.1L86 37.13a1.79 1.79 0 0 0-2.1-1.41l-7.26 1.43L78 44.09l-4.5.89L72.16 38l-7.46 1.47a1.79 1.79 0 0 0-1.41 2.1zm4-28.31l-3.76-19.23a1.79 1.79 0 0 0-2.1-1.41L58 13.32l1.37 6.94-4.5.89-1.41-6.95L46 15.67a1.79 1.79 0 0 0-1.41 2.1L48.38 37a1.79 1.79 0 0 0 2.1 1.41l19.22-3.79a1.79 1.79 0 0 0 1.41-2.1z"></path></svg>',
'SENDCLOUD_API_TRACKING_STATE_PICKED_UP_BY_DRIVER' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-10 0 125 125"><path fill="#fff" d="M98.9 66.22a5 5 0 0 1-3.9 5.87L37.38 83.43a10.08 10.08 0 1 1-10.86-5.17c.33-.06.65-.11 1-.14L16.71 23.25 2.64 10.46a5 5 0 0 1 6.73-7.4L24.66 17a5 5 0 0 1 1.54 2.7l10.56 53.66L93 62.28a5 5 0 0 1 5.9 3.94zm-62.58-19.3l3.78 19.22a1.79 1.79 0 0 0 2.1 1.41l19.22-3.78a1.79 1.79 0 0 0 1.41-2.1L59 42.44A1.79 1.79 0 0 0 56.95 41l-7.26 1.43L51 49.4l-4.5.89-1.37-6.94-7.46 1.47a1.79 1.79 0 0 0-1.35 2.1zm30.76 13.91a1.79 1.79 0 0 0 2.1 1.41l19.22-3.78a1.79 1.79 0 0 0 1.41-2.1L86 37.13a1.79 1.79 0 0 0-2.1-1.41l-7.26 1.43L78 44.09l-4.5.89L72.16 38l-7.46 1.47a1.79 1.79 0 0 0-1.41 2.1zm4-28.31l-3.76-19.23a1.79 1.79 0 0 0-2.1-1.41L58 13.32l1.37 6.94-4.5.89-1.41-6.95L46 15.67a1.79 1.79 0 0 0-1.41 2.1L48.38 37a1.79 1.79 0 0 0 2.1 1.41l19.22-3.79a1.79 1.79 0 0 0 1.41-2.1z"></path></svg>',
'SENDCLOUD_API_TRACKING_STATE_DRIVER_ON_ROUTE' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 118 118"><path fill="#fff" d="M82.58 22a6.85 6.85 0 0 0-5.78-3.17H63.55v-2.37a6.06 6.06 0 0 0-6.06-6.06H5.72A4.66 4.66 0 0 0 1 14.48a4.53 4.53 0 0 0 4.51 5h19.76A4.42 4.42 0 0 1 29.38 22a4.56 4.56 0 0 1-4.12 6.47H5.72A4.66 4.66 0 0 0 1 32.59a4.53 4.53 0 0 0 4.51 5h9.39a4.66 4.66 0 0 1 4.7 4.08 4.53 4.53 0 0 1-4.51 5H6a4.66 4.66 0 0 0-4.7 4.08 4.53 4.53 0 0 0 4.51 5h3.56v17.6a6.45 6.45 0 0 0 6.45 6.45h4.4a14.84 14.84 0 0 0 14.09 9.8 15.12 15.12 0 0 0 14.08-9.8h12.25a14.85 14.85 0 0 0 14.09 9.8 15.12 15.12 0 0 0 14.08-9.8h3.74A6.45 6.45 0 0 0 99 73.35V50.8a10.28 10.28 0 0 0-1.61-5.52zM34.31 80.2a5.64 5.64 0 0 1-5.63-5.62A5.72 5.72 0 0 1 34.31 69a5.63 5.63 0 1 1 0 11.25zm40.43 0a5.68 5.68 0 0 1-5.66-5.66 5.75 5.75 0 0 1 5.66-5.66 5.68 5.68 0 0 1 5.66 5.66 5.75 5.75 0 0 1-5.67 5.7zm10.84-32.77H65.63a1.25 1.25 0 0 1-1.25-1.25V29.73a1.25 1.25 0 0 1 1.25-1.25h9.48a1.24 1.24 0 0 1 1.05.58l10.47 16.46a1.25 1.25 0 0 1-1.05 1.91z"></path></svg>',
'SENDCLOUD_API_TRACKING_STATE_DELIVERED' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 -1 15 15" version="1.1"><g transform="translate(-185.000000, -1985.000000)" fill="#FFFFFF"><g transform="translate(40.000000, 1680.000000)"><path d="M155.83325,305.5945 C155.68825,305.4475 155.44825,305.4475 155.30225,305.5945 L149.70425,311.1815 C149.55825,311.3305 149.31925,311.3305 149.17325,311.1815 L146.72025,308.6765 C146.64825,308.6035 146.55225,308.5665 146.45725,308.5665 C146.36025,308.5655 146.26225,308.6015 146.18825,308.6765 L145.10525,309.6545 C145.03225,309.7285 144.99325,309.8215 144.99325,309.9185 C144.99325,310.0155 145.03225,310.1185 145.10525,310.1915 L149.17325,314.4055 C149.31925,314.5525 149.55825,314.5525 149.70425,314.4055 L156.89725,307.2065 C157.04325,307.0595 157.04325,306.8165 156.89725,306.6695 L155.83325,305.5945 L155.83325,305.5945 Z"></path></g></g></svg>'
]}

{assign tracking_common_key constant('\cdigruttola\Module\Sendcloudapi\Translations\TrackingTranslations::TRACKING_COMMON_KEY')}

{block name='page_title'}
    {l s='Tracking' d='Modules.Sendcloudapi.Tracking'}
{/block}

{block name='page_content_container'}
    <section id="content" class="tracking">
        {if isset($tracking)}
            <div class="tracking-header">
                <img src="https://sendcloud-prod-scp-static-files.s3.amazonaws.com/{$tracking.carrier_code}/img/icon.svg"
                     alt="{$tracking.carrier_code}" class="carrier_logo"/>
                <span><a href="{$tracking.carrier_tracking_url}"
                         target="_blank">{l s='Follow on carrier site' d='Modules.Sendcloudapi.Tracking'}</a></span>
            </div>
            {if $smarty.now|date_format:'%Y-%m-%d' <= $tracking.expected_delivery_date|strtotime|date_format:'%Y-%m-%d'}
                <p>{l s='Expect shipping for' d='Modules.Sendcloudapi.Tracking'} {$tracking.expected_delivery_date|strtotime|date_format:'%A %d/%m/%Y'}</p>
            {/if}
            <br/>
            {assign carrier_code $tracking.carrier_code|ucfirst|replace:'_':' '}
            <div class="order-tracking_timeline">
                {foreach $tracking.statuses as $status}
                    {assign parent_status {$tracking_common_key}|cat:{$status.parent_status|upper|replace:'-':' '|replace:'   ':' '|replace:' ':'_'}}
                    {assign carrier_message {$tracking_common_key}|cat:{$status.carrier_message|upper|replace:'-':' '|replace:'   ':' '|replace:' ':'_'}}
                    {if isset($trackingTranslations.$carrier_message)}
                        <div class="timeline-info">
                            <div class="timeline_line">
                                {if isset($tracking_svgs.$parent_status)}
                                    <div class="tracking-icon bg-primary">{$tracking_svgs.$parent_status|cleanHtml nofilter}</div>
                                {else}
                                    <span class="timeline_dot timeline_dot-inlined"></span>
                                {/if}
                            </div>
                            <div class="timeline-detail">
                                <div class="timeline_message">{$trackingTranslations.$carrier_message|sprintf:$carrier_code}</div>
                                <div class="timeline_datetime">{$status.carrier_update_timestamp|strtotime|date_format:'%d/%m/%Y - %H:%M'}</div>
                            </div>
                        </div>
                    {/if}
                {/foreach}
            </div>
        {elseif isset($status)}
            <div class="tracking-error">{$reason}</div>
        {else}
            <form action="#">
                <div class="col-12">
                    <div class="row tracking-form">
                        <div class="input-wrapper">
                            <label>
                                <input
                                        id="tracking_code"
                                        name="tracking_code"
                                        type="text"
                                        placeholder="{l s='Your tracking code' d='Modules.Sendcloudapi.Tracking'}">
                            </label>
                        </div>
                        <input
                                class="btn btn-primary"
                                type="submit"
                                value="{l s='Tracking' d='Modules.Sendcloudapi.Tracking'}"/>
                    </div>
                </div>
            </form>
        {/if}
    </section>
{/block}
