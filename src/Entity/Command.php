<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private $data_movimento;

    #[ORM\Column(type: 'time')]
    private $ora_movimento;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $des_causale;

    #[ORM\Column(type: 'string', length: 255)]
    private $profilo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $articolo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $des_articolo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $segno;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantita;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $un_mis;

    #[ORM\Column(type: 'float', nullable: true)]
    private $peso;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $area_or;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $zona_or;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fronte_or;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $colonna_or;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $piano_or;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $area_de;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $zona_de;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fronte_de;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $colonna_de;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $piano_de;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $riga_ord;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $stato_prod_in;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $stato_prod_fin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipo_movimento;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ditta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataMovimento(): ?\DateTimeInterface
    {
        return $this->data_movimento;
    }

    public function setDataMovimento(?\DateTimeInterface $data_movimento): self
    {
        $this->data_movimento = $data_movimento;

        return $this;
    }

    public function getOraMovimento(): ?\DateTimeInterface
    {
        return $this->ora_movimento;
    }

    public function setOraMovimento(\DateTimeInterface $ora_movimento): self
    {
        $this->ora_movimento = $ora_movimento;

        return $this;
    }

    public function getDesCausale(): ?string
    {
        return $this->des_causale;
    }

    public function setDesCausale(?string $des_causale): self
    {
        $this->des_causale = $des_causale;

        return $this;
    }

    public function getProfilo(): ?string
    {
        return $this->profilo;
    }

    public function setProfilo(string $profilo): self
    {
        $this->profilo = $profilo;

        return $this;
    }

    public function getArticolo(): ?string
    {
        return $this->articolo;
    }

    public function setArticolo(?string $articolo): self
    {
        $this->articolo = $articolo;

        return $this;
    }

    public function getDesArticolo(): ?string
    {
        return $this->des_articolo;
    }

    public function setDesArticolo(?string $des_articolo): self
    {
        $this->des_articolo = $des_articolo;

        return $this;
    }

    public function getSegno(): ?string
    {
        return $this->segno;
    }

    public function setSegno(?string $segno): self
    {
        $this->segno = $segno;

        return $this;
    }

    public function getQuantita(): ?int
    {
        return $this->quantita;
    }

    public function setQuantita(?int $quantita): self
    {
        $this->quantita = $quantita;

        return $this;
    }

    public function getUnMis(): ?string
    {
        return $this->un_mis;
    }

    public function setUnMis(?string $un_mis): self
    {
        $this->un_mis = $un_mis;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(?float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getAreaOr(): ?string
    {
        return $this->area_or;
    }

    public function setAreaOr(?string $area_or): self
    {
        $this->area_or = $area_or;

        return $this;
    }

    public function getZonaOr(): ?string
    {
        return $this->zona_or;
    }

    public function setZonaOr(?string $zona_or): self
    {
        $this->zona_or = $zona_or;

        return $this;
    }

    public function getFronteOr(): ?string
    {
        return $this->fronte_or;
    }

    public function setFronteOr(?string $fronte_or): self
    {
        $this->fronte_or = $fronte_or;

        return $this;
    }

    public function getColonnaOr(): ?string
    {
        return $this->colonna_or;
    }

    public function setColonnaOr(?string $colonna_or): self
    {
        $this->colonna_or = $colonna_or;

        return $this;
    }

    public function getPianoOr(): ?string
    {
        return $this->piano_or;
    }

    public function setPianoOr(?string $piano_or): self
    {
        $this->piano_or = $piano_or;

        return $this;
    }

    public function getAreaDe(): ?string
    {
        return $this->area_de;
    }

    public function setAreaDe(?string $area_de): self
    {
        $this->area_de = $area_de;

        return $this;
    }

    public function getZonaDe(): ?string
    {
        return $this->zona_de;
    }

    public function setZonaDe(?string $zona_de): self
    {
        $this->zona_de = $zona_de;

        return $this;
    }

    public function getFronteDe(): ?string
    {
        return $this->fronte_de;
    }

    public function setFronteDe(?string $fronte_de): self
    {
        $this->fronte_de = $fronte_de;

        return $this;
    }

    public function getColonnaDe(): ?string
    {
        return $this->colonna_de;
    }

    public function setColonnaDe(?string $colonna_de): self
    {
        $this->colonna_de = $colonna_de;

        return $this;
    }

    public function getPianoDe(): ?string
    {
        return $this->piano_de;
    }

    public function setPianoDe(?string $piano_de): self
    {
        $this->piano_de = $piano_de;

        return $this;
    }

    public function getRigaOrd(): ?int
    {
        return $this->riga_ord;
    }

    public function setRigaOrd(?int $riga_ord): self
    {
        $this->riga_ord = $riga_ord;

        return $this;
    }

    public function getStatoProdIn(): ?string
    {
        return $this->stato_prod_in;
    }

    public function setStatoProdIn(?string $stato_prod_in): self
    {
        $this->stato_prod_in = $stato_prod_in;

        return $this;
    }

    public function getStatoProdFin(): ?string
    {
        return $this->stato_prod_fin;
    }

    public function setStatoProdFin(?string $stato_prod_fin): self
    {
        $this->stato_prod_fin = $stato_prod_fin;

        return $this;
    }

    public function getTipoMovimento(): ?string
    {
        return $this->tipo_movimento;
    }

    public function setTipoMovimento(?string $tipo_movimento): self
    {
        $this->tipo_movimento = $tipo_movimento;

        return $this;
    }

    public function getDitta(): ?string
    {
        return $this->ditta;
    }

    public function setDitta(?string $ditta): self
    {
        $this->ditta = $ditta;

        return $this;
    }
}
