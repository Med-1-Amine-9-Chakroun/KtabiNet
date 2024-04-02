<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    private $errorController;

    public function __construct(ErrorController $errorController)
    {
        $this->errorController = $errorController;
    }

    public function testNotFoundError(Request $request): Response
    {    
        // Simuler une erreur 404 en appelant la méthode handleNotFoundError de ErrorController
        return $this->errorController->handleNotFoundError();
    }

    public function testInternalError(Request $request): Response
    {
        // Simuler une erreur 500 en appelant la méthode handleInternalError de ErrorController
        return $this->errorController->handleInternalError();
    }
}

?>
