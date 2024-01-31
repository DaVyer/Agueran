<?php

namespace App\Repository;

use App\Entity\Billet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Billet>
 *
 * @method Billet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Billet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Billet[]    findAll()
 * @method Billet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BilletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Billet::class);
    }

    public function findByFilters($type, $dateReservation, $dateAchat): array
    {
        if ('Tous' == $type) {
            $type = '';
        }

        $qb = $this->createQueryBuilder('b')
            ->orderBy('b.id', 'ASC');

        if ($type) {
            $qb->andWhere('b.type = :type')
                ->setParameter('type', $type);
        }

        if ($dateReservation) {
            $qb->andWhere('b.dateReservation = :dateReservation')
                ->setParameter('dateReservation', $dateReservation);
        }

        if ($dateAchat) {
            $qb->andWhere('b.dateAchat = :dateAchat')
                ->setParameter('dateAchat', $dateAchat);
        }

        return $qb->getQuery()->execute();
    }

    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.visiteur = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->execute();
    }
}
