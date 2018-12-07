<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MakerType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => MakerTranslationType::class,
            ])
            ->add('name', TextType::class)
            ->add('slug', TextType::class, [
                'label' => 'sylius.form.product.slug',
                'disabled' => null !== $builder->getData()->getSlug(),
            ])
            ->add('images', VichImageType::class, [
                'label' => 'sylius.form.product.images'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ecolos_sylius_maker_plugin_maker';
    }
}
