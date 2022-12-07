<?php

namespace App\Application\Schema\TipoProvaBundle\Entity;

use App\Application\Schema\TipoProvaBundle\Repository\TipoProvaRepository;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'tipo_prova')]
#[ORM\Entity(repositoryClass: TipoProvaRepository::class)]
#[UniqueEntity('id')]
class TipoProva
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'tipo', type: 'string', unique: false, nullable: false)]
    private string $tipo;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'descricao', type: 'string', unique: false, nullable: false)]
    private string $descricao;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


}