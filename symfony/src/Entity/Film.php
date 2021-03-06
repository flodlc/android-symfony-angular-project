<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
{
    /**
     * @Groups({"film"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"film"})
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @Groups({"film"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @Groups({"film"})
     *
     * @Groups({"film"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @Groups({"film"})
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $budget;

    /**
     * @Groups({"film"})
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantRecette;

    /**
     * @Groups({"film"})
     *
     * @ORM\ManyToOne(targetEntity="Categorie", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, nullable=true)
     */
    private $categorie;

    /**
     * @Groups({"film"})
     *
     *
     * @ORM\ManyToMany(targetEntity="Personnage", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, nullable=true)
     */
    private $personnages;

    /**
     * @Groups({"film"})
     *
     * @ORM\ManyToOne(targetEntity="Realisateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
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
        if (is_string($date)) {
            $date = \DateTime::createFromFormat("d/m/Y", $date);
        }
        if (!$date) {
            $date = null;
        }
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
    public function setRealisateur(Realisateur $realisateur)
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @param ArrayCollection $personnages
     */
    public function setPersonnages($personnages)
    {
        $this->personnages = $personnages;
    }
}
