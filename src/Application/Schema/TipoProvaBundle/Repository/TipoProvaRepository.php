<?php

namespace App\Application\Schema\TipoProvaBundle\Repository;

use App\Application\Schema\TipoProvaBundle\Entity\TipoProva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoProva>
 *
 * @method TipoProva|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoProva|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoProva[]    findAll()
 * @method TipoProva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoProvaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoProva::class);
    }


}