<?php

declare(strict_types=1);

namespace cdigruttola\Sendcloudapi\Form\DataConfiguration;

use cdigruttola\Module\SimpleBanner\Configuration\SimpleBannerConfiguration;
use PrestaShop\PrestaShop\Core\Configuration\AbstractMultistoreConfiguration;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Handles configuration data for demo multistore configuration options.
 */
final class SendCloudApiDataConfiguration extends AbstractMultistoreConfiguration
{
    public const SENDCLOUD_API_PUBLIC_KEY = 'SENDCLOUD_API_PUBLIC_KEY';
    public const SENDCLOUD_API_SECRET_KEY = 'SENDCLOUD_API_SECRET_KEY';

    private const CONFIGURATION_FIELDS = [
        'sendcloud_api_key',
        'sendcloud_api_secret',
    ];

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        return (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('sendcloud_api_key', 'string')
            ->setAllowedTypes('sendcloud_api_secret', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];
        $shopConstraint = $this->getShopConstraint();

        $return['sendcloud_api_key'] = $this->configuration->get(self::SENDCLOUD_API_PUBLIC_KEY, null, $shopConstraint);
        $return['sendcloud_api_secret'] = $this->configuration->get(self::SENDCLOUD_API_SECRET_KEY, null, $shopConstraint);

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $shopConstraint = $this->getShopConstraint();

        $this->updateConfigurationValue(self::SENDCLOUD_API_PUBLIC_KEY, 'sendcloud_api_key', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::SENDCLOUD_API_SECRET_KEY, 'sendcloud_api_secret', $configuration, $shopConstraint);

        return [];
    }
}
