<?php

namespace App\Controller;

use App\Entity\Lesson;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{

    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em->getRepository(Lesson::class);
    }

    /**
     * @Route("/lesson", name="lesson")
     * @return Response
     */
    public function index() : Response
    {

        $lessons = $this->em->findAll();

        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * @Route("/lesson/{id}", name="lesson_detail")
     * @return Response
     */
    public function detailLesson(int $id) : Response
    {

        $lesson = $this->em->find($id);

        return $this->render('lesson/detail.html.twig', [
            'lesson' => $lesson,
        ]);
    }
}
