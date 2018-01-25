<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 25/01/2018
 * Time: 11:06
 */

namespace App\Controller;

use App\Entity\Categorie;
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

class CategorieController extends Controller
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
        $this->serializer = new Serializer([new DateTimeNormalizer("d/m/y"), new ObjectNormalizer($classMetadataFactory,
            null, null, new ReflectionExtractor()), new ArrayDenormalizer()], [new JsonEncoder()]);
    }

    /**
     * @Route("/categories", name="categories")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function getCategoriesAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $RealisateurRepo = $entityManager->getRepository(Categorie::class);
        $realisateurs = $RealisateurRepo->findAll();
        return new Response($this->serializer->serialize($realisateurs, "json", ["groups" => ["categorie"]]));
    }
}