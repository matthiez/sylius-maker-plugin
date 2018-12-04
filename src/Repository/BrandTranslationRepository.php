<?php

namespace Ecolos\SyliusBrandPlugin\Repository;

use App\Entity\BrandTranslation;
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

//    /**
//     * @return AppIngredientTranslation[] Returns an array of BrandTranslation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppIngredientTranslation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
