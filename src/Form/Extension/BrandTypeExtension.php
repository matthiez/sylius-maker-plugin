<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Form\Extension;

use App\Form\Type\BrandImageType;
use App\Form\Type\BrandType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class BrandTypeExtension extends AbstractTypeExtension
{
    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [BrandImageType::class];
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
        return BrandType::class;
    }
}
