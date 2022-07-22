<?php

namespace App\Entity;


use App\Entity\TimeTrait;
use App\Entity\MyLogin;
use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Member
{
    use TimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

   
    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'members')]
    #[ORM\JoinColumn(name:"service_id", referencedColumnName:"id",onDelete:"SET NULL")]
    private $service;

    #[ORM\ManyToOne(targetEntity: Rf::class, inversedBy: 'members')]
    private $rf;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'members')]
    private $cart;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\ManyToOne(targetEntity: HourWorktime::class, inversedBy: 'members')]
    private $worktime;

    #[ORM\OneToOne(inversedBy: 'member', targetEntity: MyLogin::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $myLogin;



    // #[ORM\OneToOne(mappedBy: "member", targetEntity: MyLogin::class, cascade: ['persist', 'remove'])]
    // private $myLogin;

   
   
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyLogin(): ?MyLogin
    {
        return $this->myLogin;
    }

    public function setMyLogin(?MyLogin $myLogin): self
    {
        $this->myLogin = $myLogin;

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

    public function getRf(): ?Rf
    {
        return $this->rf;
    }

    public function setRf(?Rf $rf): self
    {
        $this->rf = $rf;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

  

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getWorktime(): ?HourWorktime
    {
        return $this->worktime;
    }

    public function setWorktime(?HourWorktime $worktime): self
    {
        $this->worktime = $worktime;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
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
        return $this->firstName;
    }

   


    


}
