<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivrePdfRepository;
use App\Repository\LivreReelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $em;
    private $clientRepository;
    private $lp;
    private $lr;
    private $commande;
    // private $em;
    public function __construct(ClientRepository $clientRepository, EntityManagerInterface $em, LivrePdfRepository $lp, LivreReelRepository $lr, CommandeRepository $commande)
    {
        $this->em = $em;
        $this->lp = $lp;
        $this->lr = $lr;
        $this->commande = $commande;
        $this->clientRepository = $clientRepository;
    }


    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig');
    }
}
