<?php

namespace App\Application\Schema\GradeCurricularBundle\Entity;

use App\Application\Schema\GradeCurricularBundle\Repository\GradeCurricularRepository;
use App\Application\Schema\CursoBundle\Entity\Curso;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'grade_curricular')]
#[ORM\Entity(repositoryClass: GradeCurricularRepository::class)]
#[UniqueEntity('id')]
class GradeCurricular
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'grade', type: 'string', unique: false, nullable: false)]
    private string $grade;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'descricao', type: 'string', unique: false, nullable: false)]
    private string $descricao;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'ativo', type: 'boolean', unique: false, nullable: false)]
    private bool $ativo;

    #[ORM\ManyToOne(targetEntity: Curso::class)]
    #[ORM\JoinColumn(name: 'curso_id', referencedColumnName: 'codigo', onDelete: 'SET NULL')]
    private Curso|null $curso = null;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getGrade(): string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    public function setCurso(?Curso $curso): void
    {
        $this->curso = $curso;
    }



}