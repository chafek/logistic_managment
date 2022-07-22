<?php

namespace App\Entity;

use App\Repository\OperatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperatorRepository::class)]
class Operator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $productivity;

    #[ORM\Column(type: 'float', nullable: true)]
    private $quality;

    #[ORM\OneToOne(inversedBy: 'operator', targetEntity: Member::class, cascade: ['persist', 'remove'])]
    private $member;

    #[ORM\ManyToOne(targetEntity: Job::class, inversedBy: 'operators')]
    private $job;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductivity(): ?float
    {
        return $this->productivity;
    }

    public function setProductivity(?float $productivity): self
    {
        $this->productivity = $productivity;

        return $this;
    }

    public function getQuality(): ?float
    {
        return $this->quality;
    }

    public function setQuality(?float $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }
}
