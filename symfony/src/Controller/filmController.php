<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 19/01/2018
 * Time: 17:46
 */
class filmController extends Controller
{
    /**
     * @Route("/films", name="films")
     */
    public function getFilmsAction()
    {
        return $this->json(["test" => "ok"]);
    }
}