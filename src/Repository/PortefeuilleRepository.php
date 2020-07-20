<?php

namespace App\Repository;

use App\Entity\Portefeuille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Portefeuille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Portefeuille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Portefeuille[]    findAll()
 * @method Portefeuille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortefeuilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Portefeuille::class);
    }

     /**
     * @return Portefeuille[] Returns an array of Portefeuille objects
     */

    public function findByExampleField($user)
    {
        return $this->createQueryBuilder('p')
            ->select('x.prix, x.quantite, x.produits, u' )
            ->join('p.placements', 'x')
            ->join('p.user', 'u')
            ->where('p.user= :user_id')
            ->setParameter('user_id', $user)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Portefeuille
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
