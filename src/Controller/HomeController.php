<?php

namespace App\Controller;

use App\Entity\Colonne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Form\InputFormType;
use App\Service\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $user = new Colonne;

        $form = $this->createForm(InputFormType::class, $user);

        $form->handleRequest($request);
     

   
        if ($form->isSubmitted() && $form->isValid()) {

             $nom = $form->getData();

             var_dump($nom);
             $this->entityManager->persist($nom);
                 $this->entityManager->flush();
                
               
// $user->setPrenom($nom);
// $this->entityManager->persist($user);
// $this->entityManager->flush();
            
           
        }


        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
