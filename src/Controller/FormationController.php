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
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om->getRepository(Formation::class);
    }

    /**
     * @Route("/formation", name="formation")
     * @return Response
     */
    public function index() : Response
    {

        $formations = $this->om->findAll();

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
        $formation = $this->om->find($id);

        return $this->render('formation/detail.html.twig', [
            'formation' => $formation
        ]);
    }
}
