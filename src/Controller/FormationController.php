<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{

    /**
     * @var FormationRepository
     */
    private $repository;

    /**
     * FormationController constructor.
     * @param FormationRepository $repository
     */
    public function __construct(FormationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/formation", name="formation")
     * @return Response
     */
    public function index() : Response
    {

        $formations = $this->repository->findAll();

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
        $formation = $this->repository->find($id);

        return $this->render('formation/detail.html.twig', [
            'formation' => $formation
        ]);
    }
}
