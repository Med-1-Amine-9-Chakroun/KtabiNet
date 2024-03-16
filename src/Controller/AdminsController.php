<?php

namespace App\Controller;


use App\Form\AdminFromType;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminsController extends AbstractController
{

    private $em;
    private $adminRepository;
    // private $em;
     public function __construct(AdminRepository $adminRepository, EntityManagerInterface $em)
     {
        $this->em =$em;
        $this->adminRepository = $adminRepository;
     }


    #[Route('/admins', name: 'app_admins')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AdminsController.php',
        ]);
    }



    #[Route('/admin/edit/{id}', name: 'app_admin_edit')]
    public function edit($id, Request $request): Response
    {
   
        $admin = $this->adminRepository->find($id);
        // if(!$this->getUser()){
        //     return $this->render('clientBase.html.twig');
        // }

        // if(!$this->getUser() !== $client){
        //     return $this->render('clientBase.html.twig');
        // }
        // dd($client);


        $form = $this->createForm(AdminFromType::class, $admin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $admin->setNomAdmin($form->get('NomAdmin')->getData());
            $admin->setPrenomAdmin($form->get('PrenomAdmin')->getData());
            $admin->setEmail($form->get('email')->getData());

            $newmdp = $form->get('NewPassword')->getData();
            $newcmdp = $form->get('confirmNewPassword')->getData();
            if($newcmdp && $newmdp){
                $admin->setPassword($form->get('confirmNewPassword')->getData());
            }
            $this->em->flush();
            // Route A modifier
            return $this->render('admin/EditProfile.html.twig', [
                'admin' => $admin,
                'form' => $form->createView()
            ]);
        }

        return $this->render('admin/EditProfile.html.twig', [
            'admin' => $admin,
            'form' => $form->createView()
        ]);
    }
}
