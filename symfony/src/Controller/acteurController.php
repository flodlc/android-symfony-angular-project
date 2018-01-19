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

class acteurController extends Controller
{
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
     */
    public function getActeursAction()
    {
        $acteurRepo = $this->getDoctrine()->getManager()->getRepository(Acteur::class);
        $acteurs = $acteurRepo->findAll();
        return new Response($this->serializer->serialize($acteurs, "json", ["groups" => ["acteur"]]));
    }

    /**
     * @Route("/acteurs/{id}", name="acteursById")
     */
    public function getActeursByIdAction($id)
    {
        $acteurRepo = $this->getDoctrine()->getManager()->getRepository(Acteur::class);
        $acteurs = $acteurRepo->find($id);
        return new Response($this->serializer->serialize($acteurs, "json", ["groups" => ["acteur"]]));
    }
}