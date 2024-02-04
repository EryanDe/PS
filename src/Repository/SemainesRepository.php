<?php

namespace App\Repository;

use App\Entity\Semaines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\Query;

use Doctrine\ORM\Query\Expr\Join;



/**
 * @extends ServiceEntityRepository<Semaines>
 *
 * @method Semaines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Semaines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Semaines[]    findAll()
 * @method Semaines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SemainesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Semaines::class);
    }
    public function getSemainesForProtocolQuery($protocolId): Query
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.exercices', 'e')
            ->join('e.protocole', 'p')
            ->where('p.id = :protocolId')
            ->setParameter('protocolId', $protocolId)
            ->getQuery();
    }

//    /**
//     * @return Semaines[] Returns an array of Semaines objects
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

//    public function findOneBySomeField($value): ?Semaines
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
