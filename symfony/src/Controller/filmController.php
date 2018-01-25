<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Personnage;
use App\Entity\Realisateur;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

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
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/Y"), new ObjectNormalizer($classMetadataFactory,
            null, null, new ReflectionExtractor()), new ArrayDenormalizer()], [new JsonEncoder()]);
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
            return new Response("", 202);
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
    public function DeleteFilmByIdAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $filmRepo = $entityManager->getRepository(Film::class);
        $film = $filmRepo->find($id);

        if (!$film) {
            return new Response("", 202);
        }

        $entityManager->remove($film);
        $entityManager->flush();
        $resp = new Response("", 200);

        return $resp;
    }

    /**
     * @Route("/film", name="postFilm")
     * @Method({"POST"})
     *
     * @return Response
     */
    public function PostFilmAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /** @var $receivedFilm Film */
        $receivedFilm = $this->serializer->denormalize($this->serializer->decode($request->getContent(), "json"), Film::class);

        if ($receivedFilm->getId()) {
            try {
                /** @var $film Film */
                $entityManager->merge($receivedFilm);
            } catch (EntityNotFoundException $e) {
                return new Response("", 202);
            }
        } else {
            /** @var $realisateur Realisateur */
            $realisateur = $entityManager->getRepository(Realisateur::class)->find($receivedFilm->getRealisateur()->getId());
            $receivedFilm->setRealisateur($realisateur);

            $persos = [];
            foreach ($receivedFilm->getPersonnages() ?? [] as $perso) {
                $persos[] = $entityManager->getRepository(Personnage::class)->find($perso->getId());
            }
            $receivedFilm->setPersonnages($persos);
            $entityManager->persist($receivedFilm);
        }

        $entityManager->flush();
        return new Response($this->serializer->serialize($receivedFilm, "json", ["groups" => ["film"]]));
    }
}