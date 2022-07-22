<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Cart
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10)]
    private $internal_number;

    #[ORM\Column(type: 'string', length: 20)]
    private $mark;

    #[ORM\Column(type: 'string', length: 255)]
    private $serial_number;

    #[ORM\Column(type: 'string', length: 50)]
    private $type;

    #[ORM\Column(type: 'datetime')]
    private $rent_date_start;

    #[ORM\Column(type: 'datetime')]
    private $rent_date_end;

    #[ORM\ManyToOne(targetEntity: ItemState::class, inversedBy: 'states')]
    private $state;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Member::class)]
    private $members;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $model;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'carts')]
    private $service;

    // #[ORM\Column(type: 'datetime_immutable')]
    // private $created_at;

    // #[ORM\Column(type: 'datetime')]
    // private $update_at;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        // $this->setUpdateAt(new \DateTime());
        // $this->setCreatedAt(new \DateTimeImmutable());
        $this->setRentDateStart(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInternalNumber(): ?string
    {
        return $this->internal_number;
    }

    public function setInternalNumber(string $internal_number): self
    {
        $this->internal_number = $internal_number;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(string $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRentDateStart(): ?\DateTimeInterface
    {
        return $this->rent_date_start;
    }

    public function setRentDateStart(\DateTimeInterface $rent_date_start): self
    {
        $this->rent_date_start = $rent_date_start;

        return $this;
    }

    public function getRentDateEnd(): ?\DateTimeInterface
    {
        return $this->rent_date_end;
    }

    public function setRentDateEnd(\DateTimeInterface $rent_date_end): self
    {
        $this->rent_date_end = $rent_date_end;

        return $this;
    }

    public function getState(): ?ItemState
    {
        return $this->state;
    }

    public function setState(?ItemState $state): self
    {
        $this->state = $state;

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
            $member->setCart($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getCart() === $this) {
                $member->setCart(null);
            }
        }

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

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
        return $this->internal_number;
    }

    // public function setCreatedAt(\DateTimeImmutable $created_at): self
    // {
    //     $this->created_at = $created_at;

    //     return $this;
    // }
}
