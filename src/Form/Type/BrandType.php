<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => BrandTranslationType::class,
            ])
            ->add('name', TextType::class)
            ->add('slug', TextType::class, [
                'label' => 'sylius.form.product.slug',
                'disabled' => null !== $builder->getData()->getSlug(),
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ecolos_sylius_brand_plugin_brand';
    }
}
