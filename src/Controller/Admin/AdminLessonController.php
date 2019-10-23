<?php


namespace App\Controller\Admin;


use App\Entity\Lesson;
use App\Form\LessonType;
use App\Repository\LessonRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLessonController extends AbstractController
{

    /**
     * @var LessonRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * AdminLessonController constructor.
     * @param LessonRepository $repository
     * @param ObjectManager $objectManager
     */
    public function __construct(LessonRepository $repository, ObjectManager $objectManager)
    {

        $this->repository = $repository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/admin/lesson", name="admin.lesson.index")
     */
    public function index() : Response
    {
        $lessons = $this->repository->findAllOrderById();

        return $this->render("admin\\lesson\\index.html.twig", compact("lessons"));
    }

    /**
     * @Route(path="/admin/lesson/create", name="admin.lesson.create")
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request) : Response
    {
        $lesson = new Lesson();
        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($lesson);
            $this->objectManager->flush();
            $this->addFlash("success", $lesson->getTitle() . " has been created");
            return $this->redirectToRoute('admin.lesson.index');
        }

        return $this->render("admin\\lesson\\new.html.twig",[
            'lesson' => $lesson,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/lesson/edit/{id}", name="admin.lesson.edit")
     * @param Lesson $lesson
     * @param Request $request
     * @return Response
     */
    public function edit(Lesson $lesson, Request $request) : Response
    {
        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->flush();
            $this->addFlash("success", $lesson->getTitle() . " has been edited");
            return $this->redirectToRoute('admin.lesson.index');
        }

        return $this->render("admin\\lesson\\edit.html.twig",[
            'lesson' => $lesson,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/lesson/delete/{id}", name="admin.lesson.delete", methods={"DELETE"})
     * @param Lesson $lesson
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Lesson $lesson, Request $request)
    {
        if($this->isCsrfTokenValid("delete" . $lesson->getId(), $request->get("_token") )) {
            $this->objectManager->remove($lesson);
            $this->objectManager->flush();
            $this->addFlash("success", $lesson->getTitle() . " has been deleted");
        }
        return $this->redirectToRoute('admin.lesson.index');
    }

}