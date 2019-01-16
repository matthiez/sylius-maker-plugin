<?php

namespace Ecolos\SyliusMakerPlugin\Form\Type\Filter;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Ecolos\SyliusMakerPlugin\Entity\MakerInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTaxon;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Core\Repository\ProductTaxonRepositoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
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
     * @param ChannelContext $channelContext
     * @param RepositoryInterface $makerRepository
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

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $taxon = $this->taxonRepository->findOneBySlug(
            $this->request->getCurrentRequest()->attributes->get("slug"),
            $this->request->getCurrentRequest()->attributes->get("_locale"));

        $makers = [];
        foreach (array_map(function (ProductTaxon $productTaxon) {
            return $productTaxon->getProduct();
        }, $this->productTaxonRepository->findBy(['taxon' => $taxon->getId()])) as $product) {
            /** @var Product $product */
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

    public function configureOptions(OptionsResolver $resolver) {
        $resolver
            ->setDefaults([
                'makers' => [],
            ])
            ->setAllowedTypes('makers', ['array']);
    }

    public function getBlockPrefix(): string {
        return 'ecolos_sylius_maker_plugin_makers_filter';
    }
}
