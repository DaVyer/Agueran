<?php

namespace App\Repository;

use App\Entity\Utiliser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Utiliser>
 *
 * @method Utiliser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utiliser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utiliser[]    findAll()
 * @method Utiliser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtiliserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utiliser::class);
    }

    public function findByActiviteId(int $getId)
    {
        $qb = $this->createQueryBuilder('u')
            ->join('u.activiter', 'a')
            ->addSelect('a')
            ->andWhere('a.id = :getId')
            ->setParameter('getId', $getId);

        return $qb->getQuery()->getResult();
    }

    public function findByAnimalId(?int $getId)
    {
        $qb = $this->createQueryBuilder('u')
            ->join('u.animal', 'a')
            ->addSelect('a')
            ->andWhere('a.id = :getId')
            ->setParameter('getId', $getId);

        return $qb->getQuery()->getResult();
    }
}
