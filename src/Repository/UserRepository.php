<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function ListAllArcher()
    {
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.isArcher = :isArcher')
            ->setParameter('isArcher', true);

        return $qb;
    }

    public function ListAllArcherNotRegistred($pelotonId)
    {
        $subQueryBuilder = $this->createQueryBuilder('c');
        $subQuery = $subQueryBuilder
            ->select('c.id')
            ->leftJoin('c.competitions', 'part')
            ->where('part.peloton = :id_peloton')                     
            ;

        $query = $this->createQueryBuilder('c3');
        $query->where($query->expr()->notIn('c3.id', $subQuery->getDQL()))
                ->andWhere('c3.isArcher = :isArcher')
                    ->setParameter('isArcher', true) 
                ->setParameter('id_peloton', $pelotonId);      

        return $query;   
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
