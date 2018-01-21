<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
    /**
     * @var Serializer
     */
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
     * @Method({"GET"})
     *
     * @return Response
     */
    public function getFilmsAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $filmRepo = $entityManager->getRepository(Film::class);
        $films = $filmRepo->findAll();
        return new Response($this->serializer->serialize($films, "json", ["groups" => ["film"]]));
    }

    /**
     * @Route("/film/{id}", name="filmById")
     * @Method({"GET"})
     *
     * @param $id
     * @return Response
     */
    public function getFilmsByIdAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $filmRepo = $entityManager->getRepository(Film::class);
        $film = $filmRepo->find($id);

        if (!$film) {
            return new Response(202);
        }

        return new Response($this->serializer->serialize($film, "json", ["groups" => ["film"]]));
    }

    /**
     * @Route("/film/{id}", name="deleteFilmById")
     * @Method({"DELETE"})
     *
     * @param $id
     * @return Response
     */
    public function DeleteFilmsByIdAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $filmRepo = $entityManager->getRepository(Film::class);
        $film = $filmRepo->find($id);

        if (!$film) {
            return new Response(202);
        }

        $entityManager->remove($film);
        $entityManager->flush();

        return new Response(200);
    }
}