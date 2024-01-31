<?php

namespace App\Repository;

use App\Entity\Reserver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reserver>
 *
 * @method Reserver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserver[]    findAll()
 * @method Reserver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserver::class);
    }

    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->execute();
    }
}
