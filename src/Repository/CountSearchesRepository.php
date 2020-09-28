<?php

namespace App\Repository;

use App\Entity\CountSearches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CountSearches|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountSearches|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountSearches[]    findAll()
 * @method CountSearches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountSearchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountSearches::class);
    }

    /**
     * @param $productId
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function incrementCounterForProduct($productId)
    {
        $connection = $this->getEntityManager()->getConnection();
        $query = $connection->prepare("UPDATE count_searches SET `count` = `count` + 1 WHERE product_id = :productId");
        $query->execute(['productId' => $productId]);
    }

    // /**
    //  * @return CountSearches[] Returns an array of CountSearches objects
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
    public function findOneBySomeField($value): ?CountSearches
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
