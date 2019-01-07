<?php

namespace Ecolos\SyliusMakerPlugin\Form\Type\Filter;

use Ecolos\SyliusMakerPlugin\Entity\MakerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sylius\Component\Channel\Context\RequestBased\ChannelContext;

class MakerFilterType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    protected $makerRepository;

    /**
     * @var ChannelContext
     */
    protected $channelContext;

    /**
     * @param ChannelContext $channelContext
     * @param RepositoryInterface $makerRepository
     */
    public function __construct(ChannelContext $channelContext, RepositoryInterface $makerRepository) {
        $this->channelContext = $channelContext;
        $this->makerRepository = $makerRepository;
    }

    public function buildForm(FormBuilderInterface $builder) {
        $builder->addModelTransformer(new CollectionToArrayTransformer());

        $builder->add(
            'makers',
            ChoiceType::class,
            [
                'choices' => array_reduce(
                    $this->makerRepository->findBy([], ['name' => 'ASC']),
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
