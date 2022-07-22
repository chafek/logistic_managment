<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TimeTrait;


#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Service
{

    use TimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $service;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Member::class,cascade: ['persist', 'remove'])]
    
    private $members;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Cart::class)]
    private $carts;

    // #[ORM\Column(type: 'datetime_immutable')]
    // private $created_at;

    // #[ORM\Column(type: 'datetime')]
    // private $update_at;

   

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->carts = new ArrayCollection();
        // $this->setCreatedAt(new \DateTimeImmutable());
        // $this->setUpdateAt(new \DateTime());
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection|Member[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setService($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getService() === $this) {
                $member->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setService($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getService() === $this) {
                $cart->setService(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }
   
  public function __toString() {
        return $this->service;
    }

//   public function setCreatedAt(\DateTimeImmutable $created_at): self
//   {
//       $this->created_at = $created_at;

//       return $this;
//   }

  
}
