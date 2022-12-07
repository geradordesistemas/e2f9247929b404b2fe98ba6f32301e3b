<?php

namespace App\Application\Schema\DisciplinaBundle\Repository;

use App\Application\Schema\DisciplinaBundle\Entity\Disciplina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Disciplina>
 *
 * @method Disciplina|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disciplina|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disciplina[]    findAll()
 * @method Disciplina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisciplinaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disciplina::class);
    }


}