<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddAdminController extends AbstractController
{
    #[Route('/add/admin', name: 'app_add_admin')]
    public function index(): Response
    {
        return $this->render('admin/AddAdmin.html.twig');
    }
}
