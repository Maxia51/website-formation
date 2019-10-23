<?php

namespace App\Controller;

use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index() : Response
    {
        $em = $this->getDoctrine()->getRepository(Formation::class);

        $formations = $em->findAll();

        if (empty($formations)) {
            return $this->render('home/index.html.twig', [
                'error' => 'Oops, it seem\'s nothing has been written yet !',
            ]);
        }

        return $this->render('home/index.html.twig', [
            'formations' => $formations,
        ]);
    }
}
