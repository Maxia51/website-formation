<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLessonController extends AbstractController
{

    /**
     * @Route(path="/admin/lesson", name="admin.lesson")
     */
    public function index() : Response
    {
        return $this->render("admin\\lesson\\index.html.twig");
    }

}