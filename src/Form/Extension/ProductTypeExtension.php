<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Form\Extension;

use Ecolos\SyliusMakerPlugin\Form\Type\MakerChoiceType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public static function getExtendedTypes()
    {
        return [
            ProductType::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maker', MakerChoiceType::class, [
                'placeholder' => 'ecolos_sylius_maker_plugin.select_maker',
                'label' => 'ecolos_sylius_maker_plugin.maker'
            ]);
    }
}
