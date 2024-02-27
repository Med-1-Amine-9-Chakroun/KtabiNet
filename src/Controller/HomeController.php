<?php

namespace App\Controller;

use App\Repository\LivreReelRepository;
use App\Repository\LivrePdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $livreReelRepository;
    private $livrePdfRepository;

    public function __construct(LivreReelRepository $livreReelRepository, LivrePdfRepository $livrePdfRepository)
    {
        $this->livreReelRepository = $livreReelRepository;
        $this->livrePdfRepository = $livrePdfRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $livresReel = $this->livreReelRepository->findAll();
        $livresPdf = $this->livrePdfRepository->findAll();

        return $this->render('home/index.html.twig', [
            'livres_reel' => $livresReel,
            'livres_pdf' => $livresPdf,
        ]);
    }

    #[Route('/meslivrespdf', name: 'app_mes_livres_pdf')]
    public function mesLivresPdf(): Response
    {
        $livresPdf = $this->livrePdfRepository->findAll();

        return $this->render('home/MesLivresPdf.html.twig', [
            'livres_pdf' => $livresPdf,
        ]);
    }

    #[Route('/meslivresreel', name: 'app_mes_livres_reel')]
    public function mesLivresReel(): Response
    {
        $livresReel = $this->livreReelRepository->findAll();

        return $this->render('home/MesLivresReel.html.twig', [
            'livres_reel' => $livresReel,
        ]);
    }
}
