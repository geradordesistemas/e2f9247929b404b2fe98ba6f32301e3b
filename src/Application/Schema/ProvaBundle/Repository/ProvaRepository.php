<?php

namespace App\Application\Schema\ProvaBundle\Repository;

use App\Application\Schema\ProvaBundle\Entity\Prova;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prova>
 *
 * @method Prova|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prova|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prova[]    findAll()
 * @method Prova[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prova::class);
    }


}