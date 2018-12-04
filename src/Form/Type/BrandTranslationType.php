<?php

namespace Ecolos\SyliusBrandPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandTranslationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('address', TextareaType::class)
            ->add('description', TextareaType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'app_brand_translation';
    }
}
