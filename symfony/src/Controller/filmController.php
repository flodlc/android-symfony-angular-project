<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 19/01/2018
 * Time: 17:46
 */
class filmController extends Controller
{
    private $serializer;
    /**
     * filmController constructor.
     */
    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/y"), new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);
    }

    /**
     * @Route("/films", name="films")
     */
    public function getFilmsAction()
    {
        $filmRepo = $this->getDoctrine()->getManager()->getRepository(Film::class);
        $films = $filmRepo->findAll();
        return new Response($this->serializer->serialize($films, "json", ["groups" => ["film"]]));
    }

    /**
     * @Route("/films/{id}", name="filmsById")
     */
    public function getFilmsByIdAction($id)
    {
        $filmRepo = $this->getDoctrine()->getManager()->getRepository(Film::class);
        $films = $filmRepo->find($id);
        return new Response($this->serializer->serialize($films, "json", ["groups" => ["film"]]));
    }
}