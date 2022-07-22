<?php

namespace App\Entity;

use App\Repository\RfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TimeTrait;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: RfRepository::class)]
class Rf
{

    use TimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $owning_date;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $model;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $serial_number;

    #[ORM\OneToMany(mappedBy: 'rf', targetEntity: Member::class)]
    private $members;

    #[ORM\ManyToOne(targetEntity: ItemState::class, inversedBy: 'carts')]
    private $state;

    


    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->setOwningDate(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOwningDate(): ?\DateTimeInterface
    {
        return $this->owning_date;
    }

    public function setOwningDate(?\DateTimeInterface $owning_date): self
    {
        $this->owning_date = $owning_date;

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

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(?string $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

     public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setRf($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getRf() === $this) {
                $member->setRf(null);
            }
        }

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
    
    public function __toString() {
        return $this->name;
    }

    public function getClassname(){
        return (new \ReflectionClass($this))->getShortName();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

   

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }
}
