<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 24/01/2018
 * Time: 20:54
 */

namespace App\Controller;


use App\Entity\Realisateur;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RealisateurController extends Controller
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * realisateurController constructor.
     */
    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/Y"), new ObjectNormalizer($classMetadataFactory,
            null, null, new ReflectionExtractor()), new ArrayDenormalizer()], [new JsonEncoder()]);
    }

    /**
     * @Route("/realisateurs", name="realisateurs")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function getFilmsAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $RealisateurRepo = $entityManager->getRepository(Realisateur::class);
        $realisateurs = $RealisateurRepo->findAll();
        return new Response($this->serializer->serialize($realisateurs, "json", ["groups" => ["realisateur"]]));
    }

}