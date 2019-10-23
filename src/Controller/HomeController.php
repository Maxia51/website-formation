<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Lesson;
use App\Repository\FormationRepository;
use App\Repository\LessonRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @var FormationRepository
     */
    private $formationRepository;

    /**
     * @var LessonRepository
     */
    private $lessonRepository;

    public function __construct(FormationRepository $formationRepository, LessonRepository $lessonRepository)
    {
        $this->formationRepository = $formationRepository;
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index() : Response
    {
        // We want only the latest formations to print on home page
        $formations = $this->formationRepository->findLatest();
        $lessons = $this->lessonRepository->findLatest();

        if (empty($formations)) {
            return $this->render('home/index.html.twig', [
                'error' => 'Oops, it seem\'s nothing has been written yet !',
            ]);
        }

        return $this->render('home/index.html.twig', [
            'formations' => $formations,
            'lessons' => $lessons
        ]);
    }
}
