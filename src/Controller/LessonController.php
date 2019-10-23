<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{

    /**
     * @var LessonRepository
     */
    private $repository;

    /**
     * LessonController constructor.
     * @param LessonRepository $repository
     */
    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository->getRepository(Lesson::class);
    }

    /**
     * @Route("/lesson", name="lesson")
     * @return Response
     */
    public function index() : Response
    {

        $lessons = $this->repository->findAll();

        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * @Route("/lesson/{id}", name="lesson_detail")
     * @param int $id
     * @return Response
     */
    public function detailLesson(int $id) : Response
    {

        $lesson = $this->repository->find($id);

        return $this->render('lesson/detail.html.twig', [
            'lesson' => $lesson,
        ]);
    }
}
