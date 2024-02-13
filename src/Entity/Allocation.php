<?php

namespace App\Entity;

use App\Repository\AllocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllocationRepository::class)]
class Allocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'allocations')]
    private ?CategoryA $categoryA = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'allocations')]
    private ?Event $event = null;

    
    public function __construct()
    {
        $this->Allocation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, categoryA>
     */
    public function getAllocation(): Collection
    {
        return $this->Allocation;
    }

    public function addAllocation(categoryA $allocation): static
    {
        if (!$this->Allocation->contains($allocation)) {
            $this->Allocation->add($allocation);
            $allocation->setAllocation($this);
        }

        return $this;
    }

    public function removeAllocation(categoryA $allocation): static
    {
        if ($this->Allocation->removeElement($allocation)) {
            // set the owning side to null (unless already changed)
            if ($allocation->getAllocation() === $this) {
                $allocation->setAllocation(null);
            }
        }

        return $this;
    }

    public function getCategoryA(): ?CategoryA
    {
        return $this->categoryA;
    }

    public function setCategoryA(?CategoryA $categoryA): static
    {
        $this->categoryA = $categoryA;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }
}
