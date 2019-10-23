<?php

namespace App\Controller;

use App\Entity\Formation;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
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
     * @Route("/formation", name="formation")
     * @return Response
     */
    public function index() : Response
    {

        $formations = $this->em->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    /**
     * @Route("/formation/{id}", name="formation_detail")
     * @param int $id
     * @return Response
     */
    public function detailFormation(int $id) : Response
    {
        $formation = $this->em->find($id);

        return $this->render('formation/detail.html.twig', [
            'formation' => $formation
        ]);
    }
}
