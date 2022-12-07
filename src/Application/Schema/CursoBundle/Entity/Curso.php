<?php

namespace App\Application\Schema\CursoBundle\Entity;

use App\Application\Schema\CursoBundle\Repository\CursoRepository;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'curso')]
#[ORM\Entity(repositoryClass: CursoRepository::class)]
#[UniqueEntity('codigo')]
class Curso
{

    #[ORM\Id]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'codigo', type: 'string', unique: true, nullable: false)]
    private ?string $codigo = null;

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


    public function __construct()
    {
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): void
    {
        $this->codigo = $codigo;
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


}