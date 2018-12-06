<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Extension;

use Ecolos\SyliusBrandPlugin\Form\Type\BrandImageType;
use Ecolos\SyliusBrandPlugin\Form\Type\BrandType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

final class BrandTypeExtension extends AbstractTypeExtension
{
    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [BrandType::class]; //BrandImageType BrandType BrandChoiceType
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('images', CollectionType::class, [
            'entry_type' => BrandImageType::class,
            'allow_add' => false,
            'allow_delete' => false,
            'by_reference' => false,
            'label' => 'sylius.form.shipping_method.images',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return BrandType::class; //BrandImageType BrandType BrandChoiceType
    }

}
