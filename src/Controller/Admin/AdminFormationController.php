<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFormationController extends AbstractController {


    /**
     * @var FormationRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * AdminFormationController constructor.
     * @param FormationRepository $repository
     * @param ObjectManager $objectManager
     */
    public function __construct(FormationRepository $repository, ObjectManager $objectManager)
    {

        $this->repository = $repository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/admin/formation", name="admin.formation.index")
     */
    public function index() : Response
    {
        $formations = $this->repository->findAllOrderById();

        return $this->render("admin\\formation\\index.html.twig", compact("formations"));
    }

    /**
     * @Route(path="/admin/formation/create", name="admin.formation.create")
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request) : Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($formation);
            $this->objectManager->flush();
            return $this->redirectToRoute('admin.formation.index');
        }

        return $this->render("admin\\formation\\new.html.twig",[
            'formation' => $formation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/formation/edit/{id}", name="admin.formation.edit")
     * @param Formation $formation
     * @param Request $request
     * @return Response
     */
    public function edit(Formation $formation, Request $request) : Response
    {
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->flush();
            return $this->redirectToRoute('admin.formation.index');
        }

        return $this->render("admin\\formation\\edit.html.twig",[
            'formation' => $formation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/formation/delete/{id}", name="admin.formation.delete", methods={"DELETE"})
     * @param Formation $formation
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Formation $formation, Request $request)
    {
        if($this->isCsrfTokenValid("delete" . $formation->getId(), $request->get("_token") )) {
            $this->objectManager->remove($formation);
            $this->objectManager->flush();
        }
        return $this->redirectToRoute('admin.formation.index');
    }

}