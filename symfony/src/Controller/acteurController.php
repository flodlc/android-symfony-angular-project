<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 19/01/2018
 * Time: 17:58
 */

namespace App\Controller;

use App\Entity\Acteur;
use App\Entity\Film;
use App\Entity\Personnage;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

class acteurController extends Controller
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ActeurController constructor.
     */
    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/y"), new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);
    }

    /**
     * @Route("/acteurs", name="acteurs")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function getActeursAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $acteurRepo = $entityManager->getRepository(Acteur::class);
        $acteurs = $acteurRepo->findAll();
        return new Response($this->serializer->serialize($acteurs, "json", ["groups" => ["acteur"]]));
    }

    /**
     * @Route("/acteur/{id}", name="acteurById")
     * @Method({"GET"})
     *
     * @param $id
     * @return Response
     */
    public function getActeursByIdAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $acteurRepo = $entityManager->getRepository(Acteur::class);
        $acteur = $acteurRepo->find($id);

        if (!$acteur) {
            return new Response(202);
        }

        return new Response($this->serializer->serialize($acteur, "json", ["groups" => ["acteur"]]));
    }

    /**
     * @Route("/acteur/{id}", name="deleteActeurById")
     * @Method({"DELETE"})
     *
     * @param $id
     * @return Response
     */
    public function DeleteActeurByIdAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $acteurRepo = $entityManager->getRepository(Acteur::class);
        $persoRepo = $entityManager->getRepository(Personnage::class);
        $filmRepo = $entityManager->getRepository(Film::class);
        $acteur = $acteurRepo->find($id);

        if (!$acteur) {
            return new Response(202);
        }

        $persos = $persoRepo->findBy(['acteur' => $acteur]);
        foreach ($persos as $perso) {
            $entityManager->remove($perso);
        }

        $entityManager->remove($acteur);
        $entityManager->flush();

        return new Response(200);
    }

    /**
     * @Route("/acteur", name="postActeur")
     * @Method({"POST"})
     *
     * @return Response
     */
    public function PostActeurAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /** @var $receivedFilm Film */
        $receivedActeur = $this->serializer->denormalize($this->serializer->decode($request->getContent(), "json"), Acteur::class);

        if ($receivedActeur->getId()) {
            try {
                /** @var $film Film */
                $entityManager->merge($receivedActeur);
            } catch (EntityNotFoundException $e) {
                return new Response("", 202);
            }
        } else {
            $entityManager->persist($receivedActeur);
        }

        $entityManager->flush();
        return new Response($this->serializer->serialize($receivedActeur, "json", ["groups" => ["acteur"]]));
    }
}