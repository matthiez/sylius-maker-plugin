<?php

namespace Ecolos\SyliusMakerPlugin\Form\Type\Filter;

use Doctrine\ORM\EntityManager;
use Ecolos\SyliusMakerPlugin\Entity\MakerInterface;
use Ecolos\SyliusMakerPlugin\Entity\ProductInterface;
use Sylius\Component\Core\Model\ProductTaxon;
use Sylius\Component\Core\Repository\ProductTaxonRepositoryInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sylius\Component\Channel\Context\RequestBased\ChannelContext;

class MakerFilterType extends AbstractType
{
    /**
     * @var ChannelContext
     */
    protected $channelContext;

    /**
     * @var EntityManager
     */
    protected $taxonRepository;

    /**
     * @var RequestStack
     */
    protected $request;

    /**
     * @var ProductTaxonRepositoryInterface
     */
    protected $productTaxonRepository;

    /**
     * MakerFilterType constructor.
     * @param ChannelContext $channelContext
     * @param TaxonRepositoryInterface $taxonRepository
     * @param RequestStack $request
     * @param ProductTaxonRepositoryInterface $productTaxonRepository
     */
    public function __construct(
        ChannelContext $channelContext,
        TaxonRepositoryInterface $taxonRepository,
        RequestStack $request,
        ProductTaxonRepositoryInterface $productTaxonRepository
    ) {
        $this->channelContext = $channelContext;
        $this->taxonRepository = $taxonRepository;
        $this->request = $request;
        $this->productTaxonRepository = $productTaxonRepository;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $taxon = $this->taxonRepository->findOneBySlug(
            $this->request->getCurrentRequest()->attributes->get("slug"),
            $this->request->getCurrentRequest()->attributes->get("_locale"));

        $makers = [];
        $products = array_map(function (ProductTaxon $productTaxon) {
            return $productTaxon->getProduct();
        }, $this->productTaxonRepository->findBy(['taxon' => $taxon->getId()]));
        foreach ($products as $product) {
            /** @var ProductInterface $product */
            if (!$product->isEnabled()) continue;

            $maker = $product->getMaker();

            if (isset($maker)) $makers[] = $maker;
        }

        usort($makers, function (MakerInterface $a, MakerInterface $b) {
            return strcmp($a->getName(), $b->getName());
        });

        $builder->addModelTransformer(new CollectionToArrayTransformer());

        $builder->add(
            'makers',
            ChoiceType::class,
            [
                'choices' => array_reduce(
                    $makers,
                    function ($arr, $maker) {
                        /** @var MakerInterface $maker */
                        $arr[$maker->getName()] = $maker->getId();

                        return $arr;
                    }, []),
                "multiple" => true,
                "label" => false,
                "translation_domain" => "ecolos_sylius_maker_plugin"
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver
            ->setDefaults([
                'makers' => [],
            ])
            ->setAllowedTypes('makers', ['array']);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string {
        return 'ecolos_sylius_maker_plugin_makers_filter';
    }
}
