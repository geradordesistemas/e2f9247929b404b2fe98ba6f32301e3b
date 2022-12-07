<?php

namespace App\Application\Schema\ProfessorBundle\Entity;

use App\Application\Schema\ProfessorBundle\Repository\ProfessorRepository;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'professor')]
#[ORM\Entity(repositoryClass: ProfessorRepository::class)]
#[UniqueEntity('id')]
class Professor
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'nome', type: 'string', unique: false, nullable: false)]
    private string $nome;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'sobrenome', type: 'string', unique: false, nullable: false)]
    private string $sobrenome;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'email', type: 'string', unique: false, nullable: false)]
    private string $email;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    public function setSobrenome(string $sobrenome): void
    {
        $this->sobrenome = $sobrenome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


}