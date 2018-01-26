<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26/01/2018
 * Time: 09:40
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

class IndexController extends Controller
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
     * @Route("/", name="index")
     * @Method({"GET"})
     *
     */
    public function getCategoriesAction()
    {
        return $this->render('index.html.twig');
    }
}