<?php

namespace App\Controller\admin;

use App\Entity\Data;
use App\Form\DataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('admin/data')]
class DataController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_data_index', methods: ['GET'])]
    public function index(): Response
    {
        $data = $this->entityManager->getRepository(Data::class)->findAll();

        return $this->render('admin/data/index.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/new', name: 'app_data_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $data = new Data();
        $form = $this->createForm(DataType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($data);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_data_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/data/new.html.twig', [
            'data' => $data,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_show', methods: ['GET'])]
    public function show(Data $data): Response
    {
        return $this->render('admin/data/show.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_data_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Data $data): Response
    {
        $form = $this->createForm(DataType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_data_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/data/edit.html.twig', [
            'data' => $data,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_delete', methods: ['POST'])]
    public function delete(Request $request, Data $data): Response
    {
        if ($this->isCsrfTokenValid('delete' . $data->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($data);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_data_index', [], Response::HTTP_SEE_OTHER);
    }
}
