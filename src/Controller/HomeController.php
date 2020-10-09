<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/hello/{prenom}/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     * @return void
     */
    public function hello($prenom = "anonyme", $age = 0){
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom,
                'age'=> $age
            ]
        );
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        $prenom = ["Sandra" =>32, "Tony"=>36, "Seb"=>38];
        return $this->render('home.html.twig',
        [
            'title' => "Bonjour à tous",
            'age' => 12,
            'tableau' =>$prenom,
        ]);
    }
}
