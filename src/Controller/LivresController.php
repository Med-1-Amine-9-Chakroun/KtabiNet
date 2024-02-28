<?php

namespace App\Controller;

use App\Entity\LivreReel;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LivresController.php',
        ]);
    }
    
    //----------------fonction afficher tous livres reels -------------------//
    #[Route('/admins/stock/livres', name: 'liste_livres')]
    public function listeLivres(EntityManagerInterface $entityManager): Response
    {
        $livreReelRepository = $entityManager->getRepository(LivreReel::class);
        $livresReels = $livreReelRepository->findAll();

        return $this->render('Stock\index.html.twig', [
            'livresReels' => $livresReels,
        ]);
    }

    //----------------fonction afficher les détails d'un livre reel -------------------//
    #[Route('/admins/stock/livres/{id}', name: 'livre_details')]
    public function livreDetails(EntityManagerInterface $entityManager, $id): Response
    {
        $livreReelRepository = $entityManager->getRepository(LivreReel::class);
        $livreReel = $livreReelRepository->find($id);

        if (!$livreReel) {
            throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
        }

        return $this->render('Stock\livre_details.html.twig', [
            'livreReel' => $livreReel,
        ]);
    }

    ////////////////////////ajouter livre réele //////////////////////
    #[Route("/admins/Stock/ajouter", name: "ajouter_page")]
    public function ajouterPage(): Response
    {
        return $this->render('/Stock/Ajouter.html.twig');
    }

    #[Route("/admins/Stock/ajouter", name: "ajouter_page", methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livreReel = new LivreReel();

        $form = $this->createFormBuilder($livreReel)
            ->add('titre', TextType::class)
            ->add('auteur', TextType::class)
            ->add('prix', TextType::class)
            ->add('description', TextType::class)
            ->add('categorie', TextType::class)
            ->add('nbrPage', TextType::class)
            ->add('solde', TextType::class)
            ->add('datePublication', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('langue', TextType::class)
            ->add('stock', TextType::class)
            ->add('imageUrl', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create LivreReel'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($livreReel);
                $entityManager->flush();

                return $this->redirectToRoute('liste_livres');
            } catch (\Exception $e) {
                return $this->render('/Stock/error.html.twig', [
                    'error' => 'An error occurred while saving the book.'
                ]);
            }
        }

        return $this->render('/Stock/Ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    ////////////////////////Modifier livre réele //////////////////////
    /**
 * @Route("/admins/stock/livres/{id}/modifier", name="modifier_livre")
 */
public function modifierLivre(EntityManagerInterface $entityManager, Request $request, $id): Response
{
    $livreReelRepository = $entityManager->getRepository(LivreReel::class);
    $livreReel = $livreReelRepository->find($id);

    if (!$livreReel) {
        throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
    }

    $form = $this->createFormBuilder($livreReel)
        ->add('titre', TextType::class)
        ->add('auteur', TextType::class)
        ->add('prix', TextType::class)
        ->add('description', TextType::class)
        ->add('categorie', TextType::class)
        ->add('nbrPage', TextType::class)
        ->add('solde', TextType::class)
        ->add('datePublication', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ])
        ->add('langue', TextType::class)
        ->add('stock', TextType::class)
        ->add('imageUrl', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Modifier LivreReel'])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        try {
            $entityManager->flush();

            return $this->redirectToRoute('liste_livres');
        } catch (\Exception $e) {
            return $this->render('/Stock/error.html.twig', [
                'error' => 'An error occurred while updating the book.'
            ]);
        }
    }

    return $this->render('Stock\modifier_livre.html.twig', [
        'form' => $form->createView(),
    ]);
}
/////////////////////////////fonction supprimer /////////////////////////////////////
/**
     * @Route("/admins/stock/livres/{id}/supprimer", name="supprimer_livre")
     */
    public function supprimerLivre(EntityManagerInterface $entityManager, $id): Response
    {
        $livreReelRepository = $entityManager->getRepository(LivreReel::class);
        $livreReel = $livreReelRepository->find($id);

        if (!$livreReel) {
            throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
        }

        
        $entityManager->remove($livreReel);
        $entityManager->flush();

        
        $this->addFlash('success', 'Livre supprimé avec succès.');

        return $this->redirectToRoute('liste_livres');
    }
    //////////////////////::
   
   
}


