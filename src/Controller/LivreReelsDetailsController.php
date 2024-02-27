<?php

namespace App\Controller;

use App\Entity\LivreReel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LivreReelsDetailsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/LivreReels/{id}', name: 'app_LivreReel')]
    public function index(int $id): Response
    {
        $LivreReel = $this->entityManager->getRepository(LivreReel::class)->find($id);

        if (!$LivreReel) {
            throw $this->createNotFoundException('LivreReel non trouvé avec cet ID : '.$id);
        }

        return $this->render('Livres/livresReelDetails.html.twig', [
            'LivreReel' => $LivreReel,
        ]);
    }
}
