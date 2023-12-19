<?php

namespace App\Repository;

use App\Entity\IntervenantEdition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IntervenantEdition>
 *
 * @method IntervenantEdition|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntervenantEdition|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntervenantEdition[]    findAll()
 * @method IntervenantEdition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntervenantEditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntervenantEdition::class);
    }

//    /**
//     * @return IntervenantEdition[] Returns an array of IntervenantEdition objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IntervenantEdition
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
