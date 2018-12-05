<?php
declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Repository;

use Ecolos\SyliusBrandPlugin\Entity\BrandTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BrandTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandTranslation[]    findAll()
 * @method BrandTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, BrandTranslation::class);
    }
}
