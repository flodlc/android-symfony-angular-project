<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $libelleCat;

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
    public function getLibelleCat()
    {
        return $this->libelleCat;
    }

    /**
     * @param string $libelleCat
     */
    public function setLibelleCat($libelleCat)
    {
        $this->libelleCat = $libelleCat;
    }

}
