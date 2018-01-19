<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $budget;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantRecette;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Personnage")
     * @ORM\JoinColumn(nullable=true)
     */
    private $personnages;

    /**
     * @ORM\ManyToOne(targetEntity="Realisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $realisateur;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param int $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return int
     */
    public function getMontantRecette()
    {
        return $this->montantRecette;
    }

    /**
     * @param int $montantRecette
     */
    public function setMontantRecette($montantRecette)
    {
        $this->montantRecette = $montantRecette;
    }

    /**
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie(Categorie $categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return ArrayCollection
     */
    public function getPersonnages()
    {
        return $this->personnages;
    }

    /**
     * @param Personnage $personnage
     */
    public function addPersonnage(Personnage $personnage){
        $this->personnages[] = $personnage;
    }

    /**
     * @param Personnage $personnage
     */
    public function removePersonnage(Personnage $personnage){
        $this->personnages->removeElement($personnage);
    }

    /**
     * @return Realisateur
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @param Realisateur $realisateur
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }


}
