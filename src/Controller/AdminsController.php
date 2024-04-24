<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AddAdminFormType;

use App\Form\AdminFromType;
use App\Form\LoginFormType;
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















    #[Route('/add/admin', name: 'app_add_admin')]
    public function addAdmin(Request $request): Response
    {
        $admin = new Admin();
        $form = $this->createForm(AddAdminFormType::class, $admin);

        $form->handleRequest($request);
        // dd($admin->getPassword());

        
        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setPassword(password_hash($admin->getPassword(), PASSWORD_BCRYPT));
            $this->em->persist($admin);
            $this->em->flush();

            // Ajout avec succès, vous pouvez rediriger vers une autre page
            return $this->redirectToRoute('app_add_admin'); // Par exemple
        }

        return $this->render('admin/AddAdmin.html.twig', [
            'form' => $form->createView()
        ]);
    }











    #[Route('/login/admin', name: 'app_login_admin')]
    public function login(Request $request): Response
    {


        $admin = new Admin();
        $form = $this->createForm(LoginFormType::class, $admin);

        $form->handleRequest($request);
        // dd($admin->getPassword())
        // Récupérer les informations d'identification de la requête
 
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier les informations d'identification dans la base de données
            
            
            $admin = $this->adminRepository->findOneByEmail($admin->getEmail());
            
            
            if (!$admin) {
                // Les informations d'identification ne sont pas valides, gérer le cas d'échec de connexion
                // Par exemple, afficher un message d'erreur à l'utilisateur
                $admin = new Admin();
                $form = $this->createForm(LoginFormType::class, $admin);

                $form->handleRequest($request);
                return $this->render('admin/LogIn.html.twig', [
                    'error' => 'Email or password is incorrect.',
                    'form' => $form->createView()
                ]);
             }
     
             return $this->redirectToRoute('admin_dashboard');
        }
        // Les informations d'identification sont valides, gérer la connexion réussie
        // Par exemple, rediriger l'utilisateur vers une page d'accueil ou un tableau de bord administratif
        
        return $this->render('admin/login/LogIn.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
