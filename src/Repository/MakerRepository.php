<?php

declare(strict_types=1);

namespace Ecolos\SyliusMakerPlugin\Repository;

use Ecolos\SyliusMakerPlugin\Entity\Maker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Maker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maker[]    findAll()
 * @method Maker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakerRepository extends ServiceEntityRepository implements MakerRepositoryInterface
{
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Maker::class);
    }
}
