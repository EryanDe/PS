<?php

namespace App\Repository;

use App\Entity\Protocoles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Protocoles>
 *
 * @method Protocoles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Protocoles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Protocoles[]    findAll()
 * @method Protocoles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtocolesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Protocoles::class);
    }

    public function countUsersByProtocole()
{
    return $this->createQueryBuilder('p')
        ->select('p.nom_protocole AS protocole', 'COUNT(u.id) AS nombreUtilisateurs')
        ->leftJoin('p.utilisateurs', 'u') 
        ->groupBy('p.id')
        ->getQuery()
        ->getResult();
}

//    /**
//     * @return Protocoles[] Returns an array of Protocoles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Protocoles
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
