<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatbotController extends AbstractController
{
    #[Route('/Client/chatbot', name: 'app_chatbot')]
    public function index(): Response
    {
        return $this->render('ChatBot/ChatBot.html.twig');
    }
}
