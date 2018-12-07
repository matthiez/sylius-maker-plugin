<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Extension;

use Ecolos\SyliusBrandPlugin\Form\Type\BrandChoiceType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public static function getExtendedTypes() {
        return [
            ProductType::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('brand', BrandChoiceType::class, [
                'placeholder' => 'ecolos_sylius_brand_plugin.select_brand',
                'label' => 'ecolos_sylius_brand_plugin.brand'
            ]);
    }
}
