<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\AST\Join;
use Symfony\Bridge\Doctrine\RegistryInterface;

class FilmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Film::class);
    }


    public function findFilmByPerso($id_perso)
    {
        $result = $this->createQueryBuilder('film')
            ->join('film.personnages', 'personnage')
            ->join('film.realisateur', 'realisateur')
            ->join('film.categorie', 'categorie')
            ->addSelect('personnage')
            ->addSelect('realisateur')
            ->addSelect('categorie')
            ->where('personnage.id = :id')
            ->setParameter('id', $id_perso)
            ->getQuery()
            ->getResult()
        ;
        return $result;
    }
}
