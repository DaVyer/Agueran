<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 *
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function search($research = ''): array
    {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('a as Animal')
            ->select('a.id, a.nomAnimal, a.descAnimal, a.lieuOriginaireAnimal')
            ->addSelect('COUNT(a) as count')
            ->where('a.nomAnimal LIKE :research')
            ->groupBy('a.id, a.nomAnimal, a.descAnimal, a.lieuOriginaireAnimal')
            ->setParameter('research', "%{$research}%")
            ->orderBy('a.nomAnimal', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findById(int $id): ?Animal
    {
        return $this->createQueryBuilder('a')
            ->addSelect('a as Animal')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByFilters(
        string $nomAnimal = '',
        string $descAnimal = '',
        string $lieuOriginaireAnimal = ''
    ): array {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('a as Animal')
            ->select('a.id, a.nomAnimal, a.descAnimal, a.lieuOriginaireAnimal')
            ->addSelect('COUNT(a) as count')
            ->where('a.nomAnimal LIKE :nomAnimal')
            ->andWhere('a.descAnimal LIKE :descAnimal')
            ->andWhere('a.lieuOriginaireAnimal LIKE :lieuOriginaireAnimal')
            ->groupBy('a.id, a.nomAnimal, a.descAnimal, a.lieuOriginaireAnimal')
            ->setParameter('nomAnimal', "%{$nomAnimal}%")
            ->setParameter('descAnimal', "%{$descAnimal}%")
            ->setParameter('lieuOriginaireAnimal', "%{$lieuOriginaireAnimal}%")
            ->orderBy('a.nomAnimal', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();
    }
}
