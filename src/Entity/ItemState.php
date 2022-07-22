<?php

namespace App\Entity;

use App\Repository\ItemStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemStateRepository::class)]
class ItemState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $note;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $designation;

    #[ORM\OneToMany(mappedBy: 'state', targetEntity: Rf::class)]
    private $rfs;

    #[ORM\OneToMany(mappedBy: 'state', targetEntity: Cart::class)]
    private $carts;


    public function __construct()
    {
        $this->rfs = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection|Rf[]
     */
    public function getRfs(): Collection
    {
        return $this->rfs;
    }

    public function addRf(Rf $rf): self
    {
        if (!$this->rfs->contains($rf)) {
            $this->rfs[] = $rf;
            $rf->setState($this);
        }

        return $this;
    }

    public function removeRf(Rf $rf): self
    {
        if ($this->rfs->removeElement($rf)) {
            // set the owning side to null (unless already changed)
            if ($rf->getState() === $this) {
                $rf->setState(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ItemState[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->states->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setState($this);
        }
        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getState() === $this) {
                $cart->setState(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
       return $this->designation; 
    }
}
