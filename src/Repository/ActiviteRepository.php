<?php

namespace App\Repository;

use App\Entity\Activite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activite>
 *
 * @method Activite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    public function search($research = ''): array
    {
        $qb = $this->createQueryBuilder('act')
            ->andWhere('act.libActivite LIKE :research')
            ->setParameter('research', '%'.$research.'%');

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findByFilters(
        string $nom = '',
        string $date = '',
        string $desc = ''
    ): array {
        $qb = $this->createQueryBuilder('a');

        if ('' !== $nom) {
            $qb->andWhere('a.libActivite LIKE :nom')
                ->setParameter('nom', '%'.$nom.'%');
        }

        if ('' !== $date) {
            $qb->andWhere('a.dateActivite = :date')
                ->setParameter('date', $date);
        }

        if ('' !== $desc) {
            $qb->andWhere('a.descActivite LIKE :desc')
                ->setParameter('desc', '%'.$desc.'%');
        }

        return $qb->getQuery()->getResult();
    }

    public function findById(int $id): ?Activite
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
