<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class BrandImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ecolos_sylius_brand_plugin_brand_image';
    }
}
