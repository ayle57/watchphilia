<?php

namespace App\Repository;

use App\Entity\SubSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubSection>
 *
 * @method SubSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubSection[]    findAll()
 * @method SubSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubSection::class);
    }

    //    /**
    //     * @return SubSection[] Returns an array of SubSection objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SubSection
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
