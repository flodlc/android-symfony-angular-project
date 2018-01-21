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
     * @var EntityManager
     */
    private $entityManager;

    /**
     * filmController constructor.
     */
    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/y"), new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);
        $this->getDoctrine()->getManager();
    }

    /**
     * @Route("/films", name="films")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function getFilmsAction()
    {
        $filmRepo = $this->entityManager->getRepository(Film::class);
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
        $filmRepo = $this->entityManager->getRepository(Film::class);
        $film = $filmRepo->find($id);
        return new Response($this->serializer->serialize($film, "json", ["groups" => ["film"]]));
    }

    /**
     * @Route("/films/{id}", name="deleteFilmById")
     * @Method({"DELETE"})
     *
     * @param $id
     * @return Response
     */
    public function DeleteFilmsByIdAction($id)
    {
        $filmRepo = $this->entityManager->getRepository(Film::class);
        $film = $filmRepo->find($id);
        $this->entityManager->remove($film);
        $this->entityManager->flush();

        return new Response(200);
    }
}