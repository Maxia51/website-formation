<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFormationController extends AbstractController {

    /**
     * @Route("/admin/formation", name="admin_formation")
     */
    public function index() : Response
    {
        return $this->render("admin\\formation\\index.html.twig");
    }

}