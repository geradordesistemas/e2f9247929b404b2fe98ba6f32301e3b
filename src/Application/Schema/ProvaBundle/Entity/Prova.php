<?php

namespace App\Application\Schema\ProvaBundle\Entity;

use App\Application\Schema\ProvaBundle\Repository\ProvaRepository;
use App\Application\Schema\ProfessorBundle\Entity\Professor;
use App\Application\Schema\DisciplinaBundle\Entity\Disciplina;
use App\Application\Schema\TipoProvaBundle\Entity\TipoProva;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'prova')]
#[ORM\Entity(repositoryClass: ProvaRepository::class)]
#[UniqueEntity('id')]
class Prova
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Professor::class)]
    #[ORM\JoinColumn(name: 'professor_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Professor|null $professor = null;

    #[ORM\ManyToOne(targetEntity: Disciplina::class)]
    #[ORM\JoinColumn(name: 'disciplina_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Disciplina|null $disciplina = null;

    #[ORM\ManyToOne(targetEntity: TipoProva::class)]
    #[ORM\JoinColumn(name: 'tipoProva_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private TipoProva|null $tipoProva = null;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProfessor(): ?Professor
    {
        return $this->professor;
    }

    public function setProfessor(?Professor $professor): void
    {
        $this->professor = $professor;
    }


    public function getDisciplina(): ?Disciplina
    {
        return $this->disciplina;
    }

    public function setDisciplina(?Disciplina $disciplina): void
    {
        $this->disciplina = $disciplina;
    }


    public function getTipoProva(): ?TipoProva
    {
        return $this->tipoProva;
    }

    public function setTipoProva(?TipoProva $tipoProva): void
    {
        $this->tipoProva = $tipoProva;
    }



}