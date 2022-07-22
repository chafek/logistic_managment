<?php

namespace App\Entity;

use App\Entity\Member;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Repository\HourWorktimeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\TimeTrait;

#[ORM\Entity(repositoryClass: HourWorktimeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class HourWorktime
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
    * @JMS\Type("DateTime<'H:i'>")
    *  
    */
    #[ORM\Column(type: 'time')]
    private $start_hour;

    /**
    * @JMS\Type("DateTime<'H:i'>")

    */
    #[ORM\Column(type: 'time')]
    private $end_hour;

    #[ORM\OneToMany(mappedBy: 'worktime', targetEntity: Member::class)]
    private $members;
    

    public function __construct()
    {
        $this->members = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartHour(): ?\DateTimeInterface
    {
        return $this->start_hour;
    }

    public function setStartHour(\DateTimeInterface $start_hour): self
    {
        $this->start_hour = $start_hour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeInterface
    {
        return $this->end_hour;
    }

    public function setEndHour(\DateTimeInterface $end_hour): self
    {
        $this->end_hour = $end_hour;

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


    /**
     * Get the value of start_hour
     */ 
    public function getStart_hour()
    {
        return $this->start_hour;
    }

    /**
     * Set the value of start_hour
     *
     * @return  self
     */ 
    public function setStart_hour($start_hour)
    {
        $this->start_hour = $start_hour;

        return $this;
    }

    /**
     * Get the value of end_hour
     */ 
    public function getEnd_hour()
    {
        return $this->end_hour;
    }

    /**
     * Set the value of end_hour
     *
     * @return  self
     */ 
    public function setEnd_hour($end_hour)
    {
        $this->end_hour = $end_hour;

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
            $member->setWorktime($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getWorktime() === $this) {
                $member->setWorktime(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->start_hour->format("H:i")." ".$this->end_hour->format("H:i");
    }

    // public function setCreatedAt(\DateTimeInterface $created_at): self
    // {
    //     $this->created_at = $created_at;

    //     return $this;
    // }

    // public function getUpdatedAt(): ?\DateTimeInterface
    // {
    //     return $this->updated_at;
    // }
  

    // public function setUpdatedAt(\DateTimeInterface $updated_at): self
    // {
    //     $this->updated_at = $updated_at;

    //     return $this;
    // }
   
    
}
