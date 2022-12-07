<?php

namespace App\Application\Schema\DisciplinaBundle\Entity;

use App\Application\Schema\DisciplinaBundle\Repository\DisciplinaRepository;
use App\Application\Schema\GradeCurricularBundle\Entity\GradeCurricular;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'disciplina')]
#[ORM\Entity(repositoryClass: DisciplinaRepository::class)]
#[UniqueEntity('id')]
class Disciplina
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'codigo', type: 'string', unique: false, nullable: false)]
    private string $codigo;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'periodo', type: 'integer', unique: false, nullable: false)]
    private int $periodo;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'nome', type: 'string', unique: false, nullable: false)]
    private string $nome;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'descricao', type: 'string', unique: false, nullable: false)]
    private string $descricao;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'ativo', type: 'boolean', unique: false, nullable: false)]
    private bool $ativo;

    #[ORM\ManyToOne(targetEntity: GradeCurricular::class)]
    #[ORM\JoinColumn(name: 'gradeCurricular_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private GradeCurricular|null $gradeCurricular = null;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getPeriodo(): int
    {
        return $this->periodo;
    }

    public function setPeriodo(int $periodo): void
    {
        $this->periodo = $periodo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
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

    public function getGradeCurricular(): ?GradeCurricular
    {
        return $this->gradeCurricular;
    }

    public function setGradeCurricular(?GradeCurricular $gradeCurricular): void
    {
        $this->gradeCurricular = $gradeCurricular;
    }



}