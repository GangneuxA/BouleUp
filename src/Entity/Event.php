<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $cashprize = null;

    #[ORM\Column]
    private ?int $maxEntrant = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbEntrant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCashprize(): ?float
    {
        return $this->cashprize;
    }

    public function setCashprize(?float $cashprize): self
    {
        $this->cashprize = $cashprize;

        return $this;
    }

    public function getMaxEntrant(): ?int
    {
        return $this->maxEntrant;
    }

    public function setMaxEntrant(int $maxEntrant): self
    {
        $this->maxEntrant = $maxEntrant;

        return $this;
    }

    public function getNbEntrant(): ?int
    {
        return $this->nbEntrant;
    }

    public function setNbEntrant(?int $nbEntrant): self
    {
        $this->nbEntrant = $nbEntrant;

        return $this;
    }
}
