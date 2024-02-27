<?php

namespace App\Controller;

use App\Entity\LivrePdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LivrePdfDetailsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/LivrePdf/{id}', name: 'app_LivrePdf')]
    public function index(int $id): Response
    {
        $LivrePdf = $this->entityManager->getRepository(LivrePdf::class)->find($id);

        if (!$LivrePdf) {
            throw $this->createNotFoundException('LivrePdf non trouvé avec cet ID : '.$id);
        }

        return $this->render('Livres/livresPdfDetails.html.twig', [
            'LivrePdf' => $LivrePdf,
        ]);
    }
}
