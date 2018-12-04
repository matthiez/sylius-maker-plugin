<?php

namespace Ecolos\SyliusBrandPlugin\Form\Type\Filter;

use Ecolos\SyliusBrandPlugin\Entity\BrandInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandFilterType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    private $brandRepository;

    /**
     * @param RepositoryInterface $brandRepository
     */
    public function __construct(RepositoryInterface $brandRepository) {
        $this->brandRepository = $brandRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addModelTransformer(new CollectionToArrayTransformer());

        $builder->add(
            'brands',
            ChoiceType::class,
            [
                'choices' => array_reduce(
                    $this->brandRepository->findBy([], ['name' => 'ASC']),
                    function ($arr, $brand) {
                        /** @var BrandInterface $brand */
                        $arr[$brand->getName()] = $brand->getId();

                        return $arr;
                    }, []),
                "multiple" => true,
                "label" => false,
                'attr' => ['class' => 'geeggee']
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver
            ->setDefaults([
                'brands' => [],
            ])
            ->setAllowedTypes('brands', ['array']);
    }

    public function getBlockPrefix(): string {
        return 'app_brands_filter';
    }
}
