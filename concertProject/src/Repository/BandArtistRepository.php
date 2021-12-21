<?php

namespace App\Repository;

use App\Entity\BandArtist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BandArtist|null find($id, $lockMode = null, $lockVersion = null)
 * @method BandArtist|null findOneBy(array $criteria, array $orderBy = null)
 * @method BandArtist[]    findAll()
 * @method BandArtist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BandArtist::class);
    }

    // /**
    //  * @return BandArtist[] Returns an array of BandArtist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BandArtist
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
