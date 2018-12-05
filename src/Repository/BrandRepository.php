<?php

declare(strict_types=1);

namespace Ecolos\SyliusBrandPlugin\Repository;

use Ecolos\SyliusBrandPlugin\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Brand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand[]    findAll()
 * @method Brand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandRepository extends ServiceEntityRepository implements BrandRepositoryInterface
{
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Brand::class);
    }
}
