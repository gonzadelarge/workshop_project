<?php

namespace App\Repository;

use App\Entity\Mecanico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mecanico|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mecanico|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mecanico[]    findAll()
 * @method Mecanico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MecanicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mecanico::class);
    }

    // /**
    //  * @return Mecanico[] Returns an array of Mecanico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mecanico
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
