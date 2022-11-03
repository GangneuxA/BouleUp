<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

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

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'event')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addEvent($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeEvent($this);
        }

        return $this;
    }
}
