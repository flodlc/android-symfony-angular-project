<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnageRepository")
 */
class Personnage
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
    private $nomPerso;

    /**
     * @ORM\ManyToOne(targetEntity="Acteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $acteur;

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
    public function getNomPerso()
    {
        return $this->nomPerso;
    }

    /**
     * @param string $nomPerso
     */
    public function setNomPerso($nomPerso)
    {
        $this->nomPerso = $nomPerso;
    }

    /**
     * @return Acteur
     */
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * @param Acteur $acteur
     */
    public function setActeur($acteur)
    {
        $this->acteur = $acteur;
    }
}
