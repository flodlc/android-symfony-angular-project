<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActeurRepository")
 */
class Acteur
{
    /**
     * @Groups({"acteur", "film"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"film", "acteur"})
     *
     * @ORM\Column(type="string")
     */
    private $nom;

    /**
     * @Groups({"film", "acteur"})
     *
     * @ORM\Column(type="string")
     */
    private $prenom;

    /**
     * @Groups({"film", "acteur"})
     *
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @Groups({"film", "acteur"})
     *
     * @ORM\Column(type="date")
     */
    private $dateDeces;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param \DateTime $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return \DateTime
     */
    public function getDateDeces()
    {
        return $this->dateDeces;
    }

    /**
     * @param \DateTime $dateDeces
     */
    public function setDateDeces($dateDeces)
    {
        $this->dateDeces = $dateDeces;
    }
}
