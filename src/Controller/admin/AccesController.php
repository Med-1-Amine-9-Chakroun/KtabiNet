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
    // private $em;
     public function __construct(AccesRepository $accesRepository, EntityManagerInterface $em)
     {
        $this->em =$em;
        $this->accesRepository = $accesRepository;
     }


    #[Route('/', name: 'app_acces_index', methods: ['GET'])]
    public function index(AccesRepository $accesRepository): Response
    {
        $accesList = $accesRepository->findAll();
        return $this->render('admin/acces/index.html.twig', [
            'accesList' => $accesList,
        ]);
    }

    #[Route('/admin/acces/{id}/edit', name: 'app_acces_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Acces $acce, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccesType::class, $acce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_acces_index', [], Response::HTTP_SEE_OTHER);
        }


// dd($form);

        return $this->renderForm('admin/acces/edit.html.twig', [
            'acce' => $acce,
            'form' => $form,
        ]);
    }
     


    #[Route('/delete/{id}', name: 'app_acces_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Acces $acce, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($acce);
        $entityManager->flush();

        $this->addFlash('success', 'L\'accès a été supprimé avec succès.');

        return $this->redirectToRoute('app_acces_index');
    }
}
