<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnageRepository")
 */
class Personnage
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
     *
     * @ORM\Column(type="string")
     */
    private $nomPerso;

    /**
     * @Groups({"film"})
     *
     * @ORM\ManyToOne(targetEntity="Acteur", cascade={"persist"})
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
    public function setActeur(Acteur $acteur)
    {
        $this->acteur = $acteur;
    }
}
