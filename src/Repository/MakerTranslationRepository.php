<?php
declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Repository;

use Ecolos\SyliusMakerPlugin\Entity\MakerTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MakerTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakerTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakerTranslation[]    findAll()
 * @method MakerTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakerTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MakerTranslation::class);
    }
}
