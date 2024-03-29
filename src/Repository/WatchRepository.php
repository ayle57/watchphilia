<?php

namespace App\Repository;

use App\Entity\Watch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Watch>
 *
 * @method Watch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Watch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Watch[]    findAll()
 * @method Watch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Watch::class);
    }

    /**
     * @return Watch[] Returns an array of Watch objects
     */
    public function findByNumber($number = 3): array
    {
        return $this->createQueryBuilder('w')
            ->orderBy('w.id', 'ASC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Watch
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
