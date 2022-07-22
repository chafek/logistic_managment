<?php

namespace App\Entity;

use App\Repository\MyLoginRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TimeTrait;

#[ORM\Entity(repositoryClass: MyLoginRepository::class)]
#[ORM\HasLifecycleCallbacks]

class MyLogin
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $reference;

    #[ORM\OneToOne(mappedBy: "myLogin", targetEntity: Member::class,cascade: ['persist', 'remove'])]
    private $member;

    // #[ORM\OneToOne(mappedBy: 'myLogin', targetEntity: Member::class, cascade: ['persist', 'remove'])]
    // private $members;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    
    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        // unset the owning side of the relation if necessary
        if ($member === null && $this->member !== null) {
            $this->member->setMyLogin(null);
        }

        // set the owning side of the relation if necessary
        if ($member !== null && $member->getMyLogin() !== $this) {
            $member->setMyLogin($this);
        }

        $this->member = $member;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function __toString()
    {
       return $this->reference; 
    }

    public function getMembers(): ?Member
    {
        return $this->members;
    }

    public function setMembers(Member $members): self
    {
        // set the owning side of the relation if necessary
        if ($members->getMyLogin() !== $this) {
            $members->setMyLogin($this);
        }

        $this->members = $members;

        return $this;
    }
}

