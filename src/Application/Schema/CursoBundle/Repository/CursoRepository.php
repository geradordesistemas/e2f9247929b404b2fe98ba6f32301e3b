<?php

namespace App\Application\Schema\CursoBundle\Repository;

use App\Application\Schema\CursoBundle\Entity\Curso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Curso>
 *
 * @method Curso|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curso|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curso[]    findAll()
 * @method Curso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Curso::class);
    }


}