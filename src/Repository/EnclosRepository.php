<?php

namespace App\Repository;

use App\Entity\Enclos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Enclos>
 *
 * @method Enclos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enclos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enclos[]    findAll()
 * @method Enclos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnclosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enclos::class);
    }

    public function findByFilters(string $nom, string $desc): array
    {
        $qb = $this->createQueryBuilder('e');

        if ($nom) {
            $qb->andWhere('e.nomEnclos LIKE :nom')
                ->setParameter('nom', '%'.$nom.'%');
        }

        if ($desc) {
            $qb->andWhere('e.descEnclos LIKE :desc')
                ->setParameter('desc', '%'.$desc.'%');
        }

        return $qb->getQuery()->getResult();
    }

    public function findByActiviteId(int $getId)
    {
        $qb = $this->createQueryBuilder('e')
            ->join('e.activite', 'a')
            ->addSelect('a')
            ->andWhere('a.id = :getId')
            ->setParameter('getId', $getId);

        return $qb->getQuery()->getResult();
    }
}
