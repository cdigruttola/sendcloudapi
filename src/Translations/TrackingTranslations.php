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

namespace cdigruttola\Module\Sendcloudapi\Translations;

class TrackingTranslations
{
    const TRACKING_COMMON_KEY = 'SENDCLOUD_API_TRACKING_STATE_';
    const STANDARD_ISO_CODE = 'en';
    const SENDCLOUD_API_TRACKING_STATE_GENERIC_ERROR = [
        'en' => 'Generic error',
        'it' => 'Errore generico',
    ];
    const SENDCLOUD_API_TRACKING_STATE_NOT_FOUND = [
        'en' => 'Could not find any shipments with this tracking number',
        'it' => 'Impossibile trovare spedizioni con questo numero di tracking',
    ];
    const SENDCLOUD_API_TRACKING_STATE_READY_TO_SEND = [
        'en' => 'Ready to send',
        'it' => 'Pronto per l\'invio',
    ];
    const SENDCLOUD_API_TRACKING_STATE_NO_LABEL = [
        'en' => 'Your shipment is expected, but not yet in the sorting process',
        'it' => 'La spedizione è prevista, ma non è ancora in fase di smistamento',
    ];
    const SENDCLOUD_API_TRACKING_STATE_BEING_ANNOUNCED = [
        'en' => 'Shipment created',
        'it' => 'Spedizione creata',
    ];
    const SENDCLOUD_API_TRACKING_STATE_HANDLED_BY_CARRIER = [
        'en' => 'Handled by %s',
        'it' => 'Gestito da %s',
    ];
    const SENDCLOUD_API_TRACKING_STATE_SHIPMENT_LEFT_ORIGIN = [
        'en' => 'Shipment left origin',
        'it' => 'Presa in carico',
    ];
    const SENDCLOUD_API_TRACKING_STATE_SHIPMENT_HELD_FOR_BEING_DELIVERED_AS_SCHEDULED = [
        'en' => 'Shipment held for being delivered as scheduled',
        'it' => 'Spedizione in attesa per essere consegnata come previsto',
    ];
    const SENDCLOUD_API_TRACKING_STATE_SHIPMENT_IN_TRANSIT = [
        'en' => 'Shipment in transit',
        'it' => 'In transito',
    ];
    const SENDCLOUD_API_TRACKING_STATE_SHIPMENT_ON_DELIVERY = [
        'en' => 'Shipment on delivery',
        'it' => 'In consegna',
    ];
    const SENDCLOUD_API_TRACKING_STATE_ADDRESSEE_NOT_AVAILABLE_RELEASE_SHIPMENT_ON_LINE = [
        'en' => 'Could not find any shipments with this tracking number.',
        'it' => 'Mancata consegna per destinatario assente',
    ];
    const SENDCLOUD_API_TRACKING_STATE_SHIPMENT_DELIVERED = [
        'en' => 'Shipment delivered',
        'it' => 'Consegna effettuata',
    ];

    /**
     *
     * @return array translation list
     */
    public function getTranslations($isoCode)
    {
        $isoCode = $this->confirmIsoCode($isoCode);

        return [
            self::TRACKING_COMMON_KEY . 'NOT_FOUND' => self::SENDCLOUD_API_TRACKING_STATE_NOT_FOUND[$isoCode],
            self::TRACKING_COMMON_KEY . 'GENERIC_ERROR' => self::SENDCLOUD_API_TRACKING_STATE_GENERIC_ERROR[$isoCode],
            self::TRACKING_COMMON_KEY . 'NO_LABEL' => self::SENDCLOUD_API_TRACKING_STATE_NO_LABEL[$isoCode],
            self::TRACKING_COMMON_KEY . 'READY_TO_SEND' => self::SENDCLOUD_API_TRACKING_STATE_READY_TO_SEND[$isoCode],
            self::TRACKING_COMMON_KEY . 'BEING_ANNOUNCED' => self::SENDCLOUD_API_TRACKING_STATE_BEING_ANNOUNCED[$isoCode],
            self::TRACKING_COMMON_KEY . 'HANDLED_BY_CARRIER' => self::SENDCLOUD_API_TRACKING_STATE_HANDLED_BY_CARRIER[$isoCode],
            self::TRACKING_COMMON_KEY . 'SHIPMENT_LEFT_ORIGIN' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_LEFT_ORIGIN[$isoCode],
            self::TRACKING_COMMON_KEY . 'THE_SHIPPING_HAS_DEPARTED' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_LEFT_ORIGIN[$isoCode],
            self::TRACKING_COMMON_KEY . 'SHIPMENT_HELD_FOR_BEING_DELIVERED_AS_SCHEDULED' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_HELD_FOR_BEING_DELIVERED_AS_SCHEDULED[$isoCode],
            self::TRACKING_COMMON_KEY . 'SHIPMENT_IN_TRANSIT' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_IN_TRANSIT[$isoCode],
            self::TRACKING_COMMON_KEY . 'IN_TRANSIT' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_IN_TRANSIT[$isoCode],
            self::TRACKING_COMMON_KEY . 'SHIPMENT_ON_DELIVERY' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_ON_DELIVERY[$isoCode],
            self::TRACKING_COMMON_KEY . 'THE_SHIPMENT_IS_READY_FOR_DELIVERY' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_ON_DELIVERY[$isoCode],
            self::TRACKING_COMMON_KEY . 'ADDRESSEE_NOT_AVAILABLE_RELEASE_SHIPMENT_ON_LINE' => self::SENDCLOUD_API_TRACKING_STATE_ADDRESSEE_NOT_AVAILABLE_RELEASE_SHIPMENT_ON_LINE[$isoCode],
            self::TRACKING_COMMON_KEY . 'SHIPMENT_DELIVERED' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_DELIVERED[$isoCode],
            self::TRACKING_COMMON_KEY . 'DELIVERED' => self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_DELIVERED[$isoCode],
        ];
    }

    /**
     * Return an ISO which can get a result in the translations arrays
     *
     * @param string $isoCode
     *
     * @return string
     */
    private function confirmIsoCode(string $isoCode): string
    {
        if (!array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_NOT_FOUND)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_GENERIC_ERROR)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_NO_LABEL)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_READY_TO_SEND)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_BEING_ANNOUNCED)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_HANDLED_BY_CARRIER)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_LEFT_ORIGIN)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_HELD_FOR_BEING_DELIVERED_AS_SCHEDULED)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_IN_TRANSIT)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_ON_DELIVERY)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_ADDRESSEE_NOT_AVAILABLE_RELEASE_SHIPMENT_ON_LINE)
            || !array_key_exists($isoCode, self::SENDCLOUD_API_TRACKING_STATE_SHIPMENT_DELIVERED)
        ) {
            return self::STANDARD_ISO_CODE;
        }

        return $isoCode;
    }
}
