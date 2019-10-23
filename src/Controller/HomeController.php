<?php

namespace App\Controller;

use App\Entity\Formation;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository Object Manager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em->getRepository(Formation::class);
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index() : Response
    {

        // We want only the latest formations to print on home page
        $formations = $this->em->findLatest();

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
