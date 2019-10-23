<?php

namespace App\Controller;

use App\Entity\Lesson;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository Object Manager
     */
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om->getRepository(Lesson::class);
    }

    /**
     * @Route("/lesson", name="lesson")
     * @return Response
     */
    public function index() : Response
    {

        $lessons = $this->om->findAll();

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

        $lesson = $this->om->find($id);

        return $this->render('lesson/detail.html.twig', [
            'lesson' => $lesson,
        ]);
    }
}
