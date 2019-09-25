<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Form\Extension;

use Ecolos\SyliusMakerPlugin\Form\Type\MakerImageType;
use Ecolos\SyliusMakerPlugin\Form\Type\MakerType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

final class MakerTypeExtension extends AbstractTypeExtension
{
    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [MakerType::class];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('images', CollectionType::class, [
            'entry_type' => MakerImageType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return MakerType::class;
    }

}
