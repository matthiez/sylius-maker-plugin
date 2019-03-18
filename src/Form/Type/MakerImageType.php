<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class MakerImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string {
        return 'ecolos_sylius_maker_plugin_maker_image';
    }
}
