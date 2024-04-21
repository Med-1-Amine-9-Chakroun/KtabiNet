<?php

namespace App\Controller\admin;

use App\Entity\Acces;
use App\Form\AccesType;
use App\Repository\AccesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/acces')]
class AccesController extends AbstractController
{
    #[Route('/', name: 'app_acces_index', methods: ['GET'])]
    public function index(AccesRepository $accesRepository): Response
    {
        return $this->render('admin/acces/index.html.twig', [
            'acces' => $accesRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acces_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Acces $acce, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccesType::class, $acce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_acces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/acces/edit.html.twig', [
            'acce' => $acce,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_acces_delete', methods: ['POST'])]
    public function delete(Request $request, Acces $acce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $acce->getId(), $request->request->get('_token'))) {
            $entityManager->remove($acce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_acces_index', [], Response::HTTP_SEE_OTHER);
    }
}
