<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArtistRepository;

class ContactController extends AbstractController
{
    //ici on crée tous les outils (les instanciations de classes Symfony ou autre) dont on aura besoin dans ce controleur,
    //pour éviter d'avoir à le faire dans chaque fonction

    //on déclare la propriété privée
    private $artistRepo;

    //on passe en paramètre la classe dont on a besoin
    // et on crée une variable qui stockera une instance de cette classe)
    public function __construct(ArtistRepository $artistRepo){

        $this->artistRepo = $artistRepo;

    }

    //Les routes ont un "path"(chemin) et un "name" (nom)

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form_contact = $this->createForm(ContactFormType::class);

        $form_contact->handleRequest($request);

        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            //on crée une instance de Contact
            $contact = new Contact();
            // Traitement des données du formulaire
            $data = $form_contact->getData();
            //on stocke les données récupérées dans la variable $message
//dd($data);
            $objet = $form_contact->get("objet")->getData();

//            dd($objet);
            $contact = $data;

            $entityManager->persist($contact);
            $entityManager->flush();

            // Redirection vers accueil
            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
//            'form' => $form->createView(),
            'form' => $form_contact
        ]);
    }


}
