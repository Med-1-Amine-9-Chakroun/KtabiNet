<?php

namespace App\Controller;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Entity\LivreReel;
use App\Entity\LivrePdf;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Dompdf\Options;


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
    
    //----------------- affiche PDF--------------//
    #[Route('/admin/stock/livre/livrePDF',name:"livrePDF")]
    public function PDF (EntityManagerInterface $tableManger){
        $livrePDFRepository = $tableManger->getRepository(LivrePdf::class);
        $livrePDF= $livrePDFRepository->findAll();
        return $this->render('admin/Stock/LivrePDF/index.html.twig',['livrePDF'=>$livrePDF]);
    }
    //--------- affiche REEL---------///
    #[Route('/admin/stock/livre/livreREEL',name:"livreREEL")]
    public function REEL (EntityManagerInterface $tableManger){
        $livreREELRepository= $tableManger->getRepository(LivreReel::class);
        $livreREEL=$livreREELRepository->findAll();
        return $this->render('admin/Stock/LivreREEL/index.html.twig',['livreREEL'=>$livreREEL]);
    }
    
    
    //__________________________________________________________________//
    ////////////////////////ajouter livre réele //////////////////////
    #[Route("/admin/stock/livre/ajouterPDF", name: "ajouterPDF", methods: ["GET", "POST"])]
    public function ajouterPDF(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livrePDF = new LivrePdf();
        $form = $this->createFormBuilder($livrePDF)
            ->add('Titre', TextType::class)
            ->add('Auteur', TextType::class)
            ->add('Prix', TextType::class)
            ->add('Description', TextType::class)
            ->add('Categorie', TextType::class)
            ->add('NbrPage', TextType::class)
            ->add('Solde', TextType::class)
            ->add('datePublication', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('langue', TextType::class)
            ->add('UrlPdf', TextType::class)
            ->add('UrlImage', TextType::class)
            
            ->getForm();
 
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $livrePDF = $form->getData();
            $entityManager->persist($livrePDF);
            $entityManager->flush();
            return $this->redirectToRoute('livrePDF');
        }
 
        return $this->render('admin/Stock/LivrePDF/AjouterPDF.html.twig', [
            'form' => $form->createView()
        ]);
    }
 
    
    //--------- Ajouter REEL---------///
    #[Route("/admin/stock/livre/ajouterREEL", name: "ajouterREEL", methods: ["GET", "POST"])]
    public function ajouterREEL(Request $request, EntityManagerInterface $entityManager): Response
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
            ->add('category', EntityType::class, [
             'class' => Category::class,
             'choice_label' => 'titre',
             'label' => 'Category',
         ])
        
           
            ->getForm();
 
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
           
                $entityManager->persist($livreReel);
                $entityManager->flush();
 
                return $this->redirectToRoute('livreREEL');
           
        }
 
        return $this->render('admin/Stock/LivreREEL/AjouterREEL.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
     //_______________________________________________________________________________________________________//
     //--------- afficher detail PDF---------///
    //  #[Route('/admin/stock/livre/DetailPDF/{id}',name:'showPDF')]
    //  public function showPDF(EntityManagerInterface $entityManager,$id):Response{
    //     $livrePDFRepository = $entityManager->getRepository(LivrePdf::class);
    //     $livrePDF = $livrePDFRepository->find($id); 
    //     return $this->render('admin/Stock/LivrePDF/DetailPDF.html.twig',['livrePDF'=> $livrePDF]);
        
    //  }
 
     //--------- afficher detail REEL---------///
     #[Route('/admin/stock/livre/DetailREEL/{id}',name:'showREEL')]
     public function showREEL(EntityManagerInterface $entityManager,$id):Response{
        $livreREELepository = $entityManager->getRepository(LivreReel::class);
        $livreREEL = $livreREELepository ->find($id); 
        if (!$livreREEL) {
            throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
        }
        return $this->render('admin/Stock/LivreREEL/DetailREEL.html.twig',['livreReel'=> $livreREEL]);
        
     }
 //_______________________________________________________________________________________________________//
 //--------- afficher edit PDF---------///
 #[Route("/admin/stock/livre/{id}/modifierPDF", name: "editPDF", methods: ["GET", "POST"])]
  
 public function editPDF(EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $livrePDFRepository = $entityManager->getRepository(LivrePdf::class);
        $livrePDF =  $livrePDFRepository->find($id);
 
        if (!$livrePDF ) {
            throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
        }
 
        $form = $this->createFormBuilder($livrePDF )
        ->add('Titre', TextType::class)
        ->add('Auteur', TextType::class)
        ->add('Prix', TextType::class)
        ->add('Description', TextType::class)
        ->add('Categorie', TextType::class)
        ->add('NbrPage', TextType::class)
        ->add('Solde', TextType::class)
        ->add('datePublication', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ])
        ->add('langue', TextType::class)
        ->add('UrlPdf', TextType::class)
        ->add('UrlImage', TextType::class)
            ->getForm();
 
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
          
                $entityManager->flush();
 
                return $this->redirectToRoute('livrePDF');
        }
 
        return $this->render('admin/Stock/LivrePDF/EditPDF.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 
 //--------- afficher edit REEL---------///
 #[Route("/admin/stock/livre/{id}/modifierREEL", name: "editREEL", methods: ["GET", "POST"])]
  
 public function editREEL(EntityManagerInterface $entityManager, Request $request, $id): Response
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
            
            
            ->getForm();
 
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
          
                $entityManager->flush();
 
                return $this->redirectToRoute('livreREEL');
        }
 
        return $this->render('admin/Stock/LivreREEL/EditREEL.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    //_______________________________________________________________________________________________________//
 //--------- supprimer PDF---------///
 #[Route("/admin/stock/livre/{id}/supprimerPDF", name: "suppPDF")]
 
    public function supprimerPDF(EntityManagerInterface $entityManager, $id): Response
    {
        $livrepdfRepository = $entityManager->getRepository(LivrePdf::class);
        $livrepdf = $livrepdfRepository ->find($id);
 
        if (!$livrepdf) {
            throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
        }
 
        
        $entityManager->remove( $livrepdf);
        $entityManager->flush();
 
        
        $this->addFlash('success', 'Livre supprimé avec succès.');
 
        return $this->redirectToRoute('livrePDF');
    }
 
    //--------- supprimer REEL---------///
    #[Route("/admin/stock/livre/{id}/supprimerREEL", name: "suppREEL")]
 
    public function supprimerREEL(EntityManagerInterface $entityManager, $id): Response
    {
        $livreReelRepository = $entityManager->getRepository(LivreReel::class);
        $livreReel = $livreReelRepository->find($id);
 
        if (!$livreReel) {
            throw $this->createNotFoundException('Livre non trouvé avec l\'ID ' . $id);
        }
 
        
        $entityManager->remove($livreReel);
        $entityManager->flush();
 
        
        $this->addFlash('success', 'Livre supprimé avec succès.');
 
        return $this->redirectToRoute('livreREEL');
    }
 //_______________________________________________________________________________________________________//
 //--------- categorie---------///
 #[Route("/admin/stock/livre/category/newcat", name: "newcategory", methods: ["GET", "POST"])]
 public function newCategory(Request $request, EntityManagerInterface $entityManager): Response
 {
     $category = new Category();
     $form = $this->createForm(CategoryType::class, $category);
     $form->handleRequest($request);
 
     if ($form->isSubmitted() && $form->isValid()) {
         $entityManager->persist($category);
         $entityManager->flush();
         $this->addFlash('success', 'Catégorie ajouté avec succès !');
     }
 
     return $this->render('admin\Stock\Categorie\AjoutCategory.html.twig', [
         'form' => $form->createView()
     ]);
 }

 //////////access PDF ///////////////////////
 private $domPdf;
 public function __construct(){
    $this->domPdf = new Dompdf();
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont','Garamond'); 
    $this->domPdf->setOptions($pdfOptions);
 }
 private function affichePDFfile($html)
{
    $domPdf = new Dompdf();
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Garamond');
    $domPdf->setOptions($pdfOptions);

    $domPdf->loadHtml($html);
    $domPdf->render();
    $domPdf->stream("details.pdf", [
        'Attachment' => false
    ]);
}
public function generateBinaryPDF($html){
    $this->domPdf->loadHtml($html);
    $this->domPdf->render();
    $this->domPdf->output();
}
//  #[Route('/pdf/{id}',name:'livre.pdf')]
//  public function generatepdf(LivrePdf $LivrePdf = null, LivresController $pdf){
//    $html = $this->render('admin/Stock/LivrePDF/DetailPDF.html.twig',['livrePDFF '=>$LivrePdf]);
//  $pdf->affichePDFfile($html);
// }
 //--------- afficher detail PDF---------///
 #[Route('/admin/stock/livre/DetailPDF/{id}', name: 'showPDF')]
 public function showPDF(EntityManagerInterface $entityManager, $id): Response
 {
     $livrePDFRepository = $entityManager->getRepository(LivrePdf::class);
     $livrePDF = $livrePDFRepository->find($id);
 
     if (!$livrePDF) {
         throw $this->createNotFoundException('Livre PDF non trouvé avec l\'ID ' . $id);
     }
 
     // Render the Twig template to get the HTML content
     $html = $this->renderView('admin/Stock/LivrePDF/DetailPDF.html.twig', ['livrePDF' => $livrePDF]);
 
     // Generate the PDF
     $this->affichePDFfile($html);
 
     // Return a response (optional)
     return new Response();
 }

 }
 
 
 
 