<?php

namespace App\Controller\admin;

use App\Entity\Acces;
use App\Form\AccesType;
use App\Repository\AccesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/acces')]
class AccesController extends AbstractController
{

    private $em;
    private $accesRepository;

    public function __construct(AccesRepository $accesRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->accesRepository = $accesRepository;
    }

    #[Route('/', name: 'app_acces_index', methods: ['GET'])]
    public function index(): Response
    {
        $accesList = $this->accesRepository->findAll();
        return $this->render('admin/acces/index.html.twig', [
            'accesList' => $accesList,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acces_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Acces $acces): Response
    {
        $form = $this->createForm(AccesType::class, $acces);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('app_acces_index');
        }

        return $this->render('admin/acces/edit.html.twig', [
            'acce' => $acces,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_acces_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Acces $acces): Response
    {
        try {
            $this->em->beginTransaction();
            $this->em->remove($acces);
            $this->em->flush();
            $this->em->commit();
            $this->addFlash('success', 'L\'accès a été supprimé avec succès.');
        } catch (\Exception $e) {
            $this->em->rollback();
            $this->addFlash('error', 'Une erreur s\'est produite lors de la suppression de l\'accès.');
        }

        return $this->redirectToRoute('app_acces_index');
    }
}
