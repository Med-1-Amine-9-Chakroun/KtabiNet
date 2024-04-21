<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Acces;
use App\Entity\LivrePdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;

class AccesController extends AbstractController
{   
    private $entityManager;
    private $security;
    private $session;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, Security $security,  RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->requestStack = $requestStack;
    }
    #[Route('/request-access/{id}', name: 'request_access')]
    public function requestAccess(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $livrePdf = $entityManager->getRepository(LivrePdf::class)->find($id);

        if (!$livrePdf) {
            throw $this->createNotFoundException('The book does not exist');
        }
        
        $user = $this->getUser();
        $client = $this->entityManager->getRepository(Client::class)->find($user->getId());

        if ($request->isMethod('POST')) {
            $date = $request->request->get('date');
            $acces = $request->request->get('acces');

            $accesRequest = new Acces();
            $accesRequest->setIdLivrePdf($livrePdf);
            $accesRequest->setDate(new \DateTime($date));
            $accesRequest->setAcces(false);
            $accesRequest->setIdClient($client);
            

            $entityManager->persist($accesRequest);
            $entityManager->flush();

            $this->addFlash('success', 'Access request submitted successfully.');

            // Redirect to a success page or do something else
            return $this->redirectToRoute('app_LivrePdf', ['id' => $id]);
        }

        return $this->render('acces_livre_pdf/index.html.twig', [
            'livrePdf' => $livrePdf,
        ]);
    }
}