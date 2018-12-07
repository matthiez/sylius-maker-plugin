<?php

namespace Ecolos\SyliusBrandPlugin\Form\Type\Filter;

use Ecolos\SyliusBrandPlugin\Entity\BrandInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Sylius\Component\Channel\Context\RequestBased\ChannelContext;
use Sylius\Component\Channel\Context\RequestBased\CompositeRequestResolver;
use Sylius\Component\Core\Context\ShopperContext;

class BrandFilterType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    protected $brandRepository;


    /**
     * @var ChannelContext
     */
    protected $channelContext;

    /**
     * @param ChannelContext $channelContext
     * @param RepositoryInterface $brandRepository
     */
    public function __construct(ChannelContext $channelContext, RepositoryInterface $brandRepository) {
        $this->channelContext = $channelContext;
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
                "label" => false
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
        return 'ecolos_sylius_brand_plugin_brands_filter';
    }
}
