<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Extension;

use Ecolos\SyliusBrandPlugin\Form\Type\BrandType;
use Symfony\Component\Form\AbstractTypeExtension;

final class BrandTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedTypes()
    {
        return [
            BrandType::class
        ];
    }
}
