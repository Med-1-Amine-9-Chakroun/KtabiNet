<?php

namespace App\Controller;

use App\Form\ClientFormType;

use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends AbstractController
{

    private $em;
    private $clientRepository;
    // private $em;
     public function __construct(ClientRepository $clientRepository, EntityManagerInterface $em)
     {
        $this->em =$em;
        $this->clientRepository = $clientRepository;
     }

    #[Route('/clients', name: 'app_clients')]
    public function index(): JsonResponse
    {
        
         
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClientsController.php',
        ]);
    }


    #[Route('/client/edit/{id}', name: 'app_client_edit')]
    public function edit($id): Response
    {
        $client = $this->clientRepository->find($id);
        $form = $this->createForm(ClientFormType::class, $client);
        // dd($client);
        return $this->render('Client/EditProfile.html.twig', [
            'client' => $client,
            'form' => $form->createView()
        ]);
    }
}
