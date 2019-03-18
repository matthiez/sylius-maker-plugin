<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class MakerTranslationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('address', TextareaType::class, [
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'required' => false
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ecolos_sylius_maker_plugin_maker_translation';
    }
}
