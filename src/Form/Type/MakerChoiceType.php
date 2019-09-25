<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Form\Type;

use Ecolos\SyliusMakerPlugin\Entity\MakerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class MakerChoiceType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    private $makerRepository;

    /**
     * @param RepositoryInterface $makerRepository
     */
    public function __construct(RepositoryInterface $makerRepository)
    {
        $this->makerRepository = $makerRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple'])
            $builder->addModelTransformer(new CollectionToArrayTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => array_reduce(
                $this->makerRepository->findBy([], ['name' => 'ASC']),
                function ($arr, $maker) {
                    /** @var MakerInterface $maker */
                    $arr[$maker->getName()] = $maker;

                    return $arr;
                }, []),
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'ecolos_sylius_maker_plugin_maker_choice';
    }
}
