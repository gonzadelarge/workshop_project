<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;


    class HomeController extends AbstractController
    {

        /**
         * @Route("/home", name="showHome")
         */
        public function showHome() {
            return $this->render("home/home.html.twig");
        }

    }