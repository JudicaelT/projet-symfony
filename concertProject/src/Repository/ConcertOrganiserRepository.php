<?php

namespace App\Repository;

use App\Entity\ConcertOrganiser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConcertOrganiser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcertOrganiser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcertOrganiser[]    findAll()
 * @method ConcertOrganiser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertOrganiserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcertOrganiser::class);
    }

    // /**
    //  * @return ConcertOrganiser[] Returns an array of ConcertOrganiser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConcertOrganiser
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
