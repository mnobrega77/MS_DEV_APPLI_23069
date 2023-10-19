<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArtistRepository;

class HomeController extends AbstractController
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

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $test = "test";
        $this->artistRepo->findAll();

        //les variables qu'on veut utiliser côté vue doivent se trouver dans le tableau de paramètres
        //de la fonction "render"

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'test' =>$test
            
        ]);
    }

    #[Route('/home2', name: 'app_home2')]
    public function index2(ArtistRepository $artistRepo ): Response
    {
        //une route peut aussi ne pas afficger de page, mais juste faire une redirection
       
        return $this->redirectToRoute('app_home');
    }
}
