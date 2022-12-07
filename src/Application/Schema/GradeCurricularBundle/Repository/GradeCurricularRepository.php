<?php

namespace App\Application\Schema\GradeCurricularBundle\Repository;

use App\Application\Schema\GradeCurricularBundle\Entity\GradeCurricular;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GradeCurricular>
 *
 * @method GradeCurricular|null find($id, $lockMode = null, $lockVersion = null)
 * @method GradeCurricular|null findOneBy(array $criteria, array $orderBy = null)
 * @method GradeCurricular[]    findAll()
 * @method GradeCurricular[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GradeCurricularRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GradeCurricular::class);
    }


}