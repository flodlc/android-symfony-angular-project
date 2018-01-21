<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 19/01/2018
 * Time: 17:58
 */

namespace App\Controller;

use App\Entity\Acteur;
use Doctrine\Common\Annotations\AnnotationReader;
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

class acteurController extends Controller
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
     * ActeurController constructor.
     */
    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/y"), new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);
        $this->entityManager = $this->getDoctrine()->getManager();
    }

    /**
     * @Route("/acteurs", name="acteurs")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function getActeursAction()
    {
        $acteurRepo = $this->entityManager->getRepository(Acteur::class);
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
        $acteurRepo = $this->entityManager->getRepository(Acteur::class);
        $acteur = $acteurRepo->find($id);
        return new Response($this->serializer->serialize($acteur, "json", ["groups" => ["acteur"]]));
    }

    /**
     * @Route("/acteur/{id}", name="deleteActeurById")
     * @Method({"DELETE"})
     *
     * @param $id
     * @return Response
     */
    public function DeleteFilmsByIdAction($id)
    {
        $acteurRepo = $this->entityManager->getRepository(Acteur::class);
        $acteur = $acteurRepo->find($id);
        $this->entityManager->remove($acteur);
        $this->entityManager->flush();

        return new Response(200);
    }
}