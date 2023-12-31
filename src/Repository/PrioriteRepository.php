<?php

namespace App\Repository;

use App\Entity\Priorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Priorite>
 *
 * @method Priorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Priorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Priorite[]    findAll()
 * @method Priorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrioriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Priorite::class);
    }
}
